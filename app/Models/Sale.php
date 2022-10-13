<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'batch_id',
        'status',
        'amount',
        'amount_paid',
        'dues',
        'cuote_account',
        'cuote_paid',
        'paid_comming',
        'paid_comming'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function lote()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

    public function project()
    {
        return $this->belongsTo(Batch::class, 'project_id');
    }

    public function group()
    {
        return $this->belongsTo(Batch::class, 'group_id');
    }

}
