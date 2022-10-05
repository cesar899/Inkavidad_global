<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'ref_number',
        'payment_proof',
        'amount',
        'status',
        'user_id',
        'seller_id',
        'batch_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
}

