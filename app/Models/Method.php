<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function macroprocess()
    {
        return $this->belongsTo(Macroprocess::class);
    }

    public function processes()
    {
        return $this->hasMany(Process::class);
    }
}
