<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
  protected $fillable = [
    'user_id',
    'reason',
    'status',
    'reviewed_by',
  ];

    protected static function booted()
    {
        static::updating(function (Collaborator $collaborator) {
            if ($collaborator->isDirty('status') && in_array($collaborator->status, ['approved', 'rejected'])) {
                $collaborator->reviewed_by = auth()->id();
            }
        });

        static::updated(function (Collaborator $collaborator) {
            if ($collaborator->isDirty('status') && $collaborator->status === 'approved') {
                $collaborator->user()->update(['role' => 'collaborator']);
            } elseif ($collaborator->isDirty('status') && $collaborator->status === 'rejected') {
                $collaborator->user()->update(['role' => 'reguler']);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
