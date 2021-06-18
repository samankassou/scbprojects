<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Process extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'reference',
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

    protected $appends = ['last_version'];

    public function versions()
    {
        return $this->hasMany(ProcessVersion::class, 'process_id');
    }

    public function getLastVersionAttribute()
    {
        return $this->versions()->latest()->first()->load('entities.pole');
    }

    public function method()
    {
        return $this->belongsTo(Method::class);
    }

    public function process_modifications()
    {
        return $this->hasMany(ProcessModification::class);
    }

    public function deleter()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
