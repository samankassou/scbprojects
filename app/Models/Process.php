<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'creation_date',
        'writing_date',
        'date_of_approval',
        'validation_date',
        'broardcasting_date'
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
        'writing_date',
        'date_of_approval',
        'verification_date',
        'broardcasting_date',
        'state',
        'deleted_by',
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
