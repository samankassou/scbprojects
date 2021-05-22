<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $dates = ['start_date', 'end_date'];

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'sponsor',
        'initiative',
        'amoa',
        'moe',
        'manager',
        'cost',
        'status',
        'progress',
        'benefits',
        'documentation',
        'bills'
    ];

    public function natures()
    {
        return $this->belongsToMany(Nature::class);
    }

    public function steps()
    {
        return $this->belongsToMany(Step::class);
    }

    public function getStartYearAttribute()
    {
        return $this->start_date->year;
    }
}
