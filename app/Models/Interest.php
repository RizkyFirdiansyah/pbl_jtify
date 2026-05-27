<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
  protected $fillable = [
    'user_id',
    'information_id',
    'status',
    'consented_at',
  ];

  protected function casts(): array
  {
    return [
      'consented_at' => 'datetime',
    ];
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function information()
  {
    return $this->belongsTo(Information::class);
  }
}
