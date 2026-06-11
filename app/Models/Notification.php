<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'information_id',
        'title',
        'message',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
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

    public static function generateBookmarkReminders($userId)
    {
        $bookmarks = \App\Models\Bookmark::where('user_id', $userId)
            ->where('reminder_enabled', true)
            ->with('information.category')
            ->get();

        foreach ($bookmarks as $bookmark) {
            $info = $bookmark->information;
            if (!$info || !$info->deadline) {
                continue;
            }

            // Hitung sisa hari dari deadline
            $deadline = \Carbon\Carbon::parse($info->deadline)->startOfDay();
            $today = \Carbon\Carbon::today();
            $daysRemaining = $today->diffInDays($deadline, false); // false agar bisa negatif jika sudah lewat

            // H-7 Reminder
            if ($daysRemaining <= 7) {
                $hasH7 = self::where('user_id', $userId)
                    ->where('information_id', $info->id)
                    ->where('title', 'like', '%H-7%')
                    ->exists();

                if (!$hasH7) {
                    self::create([
                        'user_id' => $userId,
                        'information_id' => $info->id,
                        'title' => 'Pengingat H-7: ' . ($info->category?->name ?? 'Informasi'),
                        'message' => 'Batas waktu pendaftaran "' . $info->title . '" tinggal 7 hari lagi (' . $deadline->format('d M Y') . '). Jangan sampai terlewat!',
                        'is_read' => false,
                    ]);
                }
            }

            // H-3 Reminder
            if ($daysRemaining <= 3) {
                $hasH3 = self::where('user_id', $userId)
                    ->where('information_id', $info->id)
                    ->where('title', 'like', '%H-3%')
                    ->exists();

                if (!$hasH3) {
                    self::create([
                        'user_id' => $userId,
                        'information_id' => $info->id,
                        'title' => 'Pengingat H-3: ' . ($info->category?->name ?? 'Informasi'),
                        'message' => 'Batas waktu pendaftaran "' . $info->title . '" tinggal 3 hari lagi (' . $deadline->format('d M Y') . '). Selesaikan pendaftaran Anda!',
                        'is_read' => false,
                    ]);
                }
            }
        }
    }
}
