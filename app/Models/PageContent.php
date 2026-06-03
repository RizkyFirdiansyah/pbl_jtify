<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
  protected $fillable = [
    'page_id',
    'content_key',
    'content_type',
    'content_value',
    'sort_order',
    'is_active',
    'user_id',
  ];

  protected function casts(): array
  {
    return [
      'sort_order' => 'integer',
      'is_active' => 'boolean',
    ];
  }

  public function page()
  {
    return $this->belongsTo(Page::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
