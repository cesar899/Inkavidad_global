<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
    	'batch_id',
    	'seller_id',
    	'user_id',
    	'status',
    	'amount',
    	'amount_paid',
    	'dues',
    ];

    public function batch() {
    	return $this->belongsTo(Batch::class);
    }

    public function seller() {	
    	return $this->belongsTo(User::class);
    }

    public function user() {
    	return $this->belongsTo(User::class);
    }
}
