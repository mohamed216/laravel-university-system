<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineAttendance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'online_lecture_id',
        'student_id',
        'joined_at',
        'left_at',
        'duration_minutes',
        'is_present',
        'notes',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
        'left_at' => 'datetime',
        'is_present' => 'boolean',
    ];

    public function onlineLecture()
    {
        return $this->belongsTo(OnlineLecture::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function calculateDuration()
    {
        if ($this->joined_at && $this->left_at) {
            return $this->joined_at->diffInMinutes($this->left_at);
        }
        return 0;
    }
}
