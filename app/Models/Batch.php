<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_id',
        'seller_id',
        'project_id',
        'name',
        'mts_north',
        'mts_south',
        'mts_est',
        'mts_west',
        'adjoins_north',
        'adjoins_south',
        'adjoins_est',
        'adjoins_west',
        'amount_owed',
        'amount',
    ];
    
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
