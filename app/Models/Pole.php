<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pole extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['name'];

    public function entities()
    {
        return $this->hasMany(Entity::class);
    }
}
