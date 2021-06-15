<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessModification extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'process_id'];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
