<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'last_name',
        'address',
        'email',
        'password',
        'rol',
        'countrie_id',
        'prefix_id',
        'type_dni',
        'dni',
        'phone',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*funciones de jwt*/
    public function getJWTIdentifier(){
        return $this->getKey();
    }
    public function batches()
    {
        return $this->hasMany(Batch::class, 'user_id');
    }
    public function batchesSold()
    {
        return $this->hasMany(Batch::class, 'seller_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }
    public function buy()
    {
        return $this->hasMany(Sale::class, 'user_id');
    }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'seller_id');
    }
    public function ordersSold()
    {
        return $this->hasMany(Order::class, 'seller_id');
    }
    public function getJWTCustomClaims(){
        return [];
    }

    //relacion de usuario con rol
    public function Roles() {
        return $this->belongsTo(Role::class, 'rol');
    }
}
