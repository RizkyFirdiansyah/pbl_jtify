<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
  protected $fillable = [
    'name',
    'slug',
    'description',
    'is_active',
    'user_id',
  ];

  protected function casts(): array
  {
    return [
      'is_active' => 'boolean',
    ];
  }

  protected static function booted(): void
  {
    static::creating(function ($page) {
      if (empty($page->slug)) {
        $page->slug = Str::slug($page->name);
      }
    });

    static::updating(function ($page) {
      if ($page->isDirty('name')) {
        $page->slug = Str::slug($page->name);
      }
    });
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function contents()
  {
    return $this->hasMany(PageContent::class);
  }
}
