<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['start_date', 'end_date'];
    protected $appends = ['start_year'];

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
        'saved_by',
        'deleted_by',
        'benefits',
        'documentation',
        'bills'
    ];

    public function natures()
    {
        return $this->belongsToMany(Nature::class);
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'saved_by', 'id');
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }

    public function steps()
    {
        return $this->belongsToMany(Step::class);
    }

    public function modifications()
    {
        return $this->hasMany(ProjectModification::class);
    }

    public function getStartYearAttribute()
    {
        return $this->start_date->year;
    }
}
