<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $dates = [
        'creation_date',
        'written_date',
        'approved_date',
        'validation_date',
        'diffusion_date'
    ];

    protected $fillable = [
        'name',
        'method_id',
        'version',
        'type',
        'status',
        'created_by',
        'written_by',
        'verified_by',
        'approved_by',
        'creation_date',
        'written_date',
        'approved_date',
        'verification_date',
        'diffusion_date',
        'state',
        'reasons_for_creation',
        'reasons_for_modification',
        'appendices'
    ];

    public function entities()
    {
        return $this->belongsToMany(Entity::class);
    }

    public function method()
    {
        return $this->belongsTo(Method::class);
    }
}
