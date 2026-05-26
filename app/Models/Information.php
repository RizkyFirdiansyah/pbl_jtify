<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Information extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'deadline',
        'registration_link',
        'guidebook_link',
        'poster_path',
        'status',
        'approved_by',
        'approved_at',
        'revision_notes',
    ];

    protected function casts(): array
    {
        return [
            'deadline' => 'date',
            'approved_at' => 'datetime',
            'deleted_at' => 'datetime',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($information) {
            if (empty($information->slug)) {
                $information->slug = Str::slug($information->title);
            }
        });

        static::updating(function ($information) {
            if ($information->isDirty('title')) {
                $information->slug = Str::slug($information->title);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }

    public function recruitments()
    {
        return $this->hasMany(Recruitment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
