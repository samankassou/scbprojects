<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessVersion extends Model
{
    use HasFactory;

    protected $dates = [
        'creation_date',
        'writing_date',
        'date_of_approval',
        'verification_date',
        'broadcasting_date'
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
        'reasons_for_creation',
        'reasons_for_modification',
        'appendices'
    ];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function entities()
    {
        return $this->belongsToMany(Entity::class);
    }
}
