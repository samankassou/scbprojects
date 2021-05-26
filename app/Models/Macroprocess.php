<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Macroprocess extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }

    public function methods()
    {
        return $this->hasMany(Method::class);
    }
}
