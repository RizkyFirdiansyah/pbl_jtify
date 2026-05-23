<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Article extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'slug',
        'poster_path',
        'status',
        'approved_by',
        'approved_at',
        'revision_notes',
    ];

    protected function casts(): array
    {
        return [
            'approved_at' => 'datetime',
            'deleted_at'  => 'datetime',
        ];
    }

    /**
     * Boot model: otomatis generate slug dari title.
     */
    protected static function booted(): void
    {
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    /**
     * Pemilik artikel (penulis).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Admin yang menyetujui artikel.
     */
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}