<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'user_id',
        'information_id',
        'reminder_enabled',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function information()
    {
        return $this->belongsTo(Information::class);
    }
}
