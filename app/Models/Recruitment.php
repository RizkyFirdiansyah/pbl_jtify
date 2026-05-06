<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    protected $fillable = [
        'information_id',
        'role_name',
        'slots_available',
    ];

    public function information()
    {
        return $this->belongsTo(Information::class);
    }
}
