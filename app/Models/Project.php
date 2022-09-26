<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'plan',
        'status',
        'featured_image',
        'group_quantity',
    ];

    public function batchs()
    {
        return $this->hasMany(Batch::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
    }

}
