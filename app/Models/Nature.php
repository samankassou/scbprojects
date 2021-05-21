<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nature extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}
