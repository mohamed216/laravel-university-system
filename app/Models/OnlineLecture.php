<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnlineLecture extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_section_id',
        'professor_id',
        'title',
        'description',
        'meeting_link',
        'video_url',
        'meeting_id',
        'meeting_password',
        'scheduled_at',
        'duration_minutes',
        'status',
        'notes',
        'is_recording_enabled',
        'recording_url',
        'open_access_at',
        'close_access_at',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'is_recording_enabled' => 'boolean',
        'open_access_at' => 'datetime',
        'close_access_at' => 'datetime',
    ];

    public function courseSection()
    {
        return $this->belongsTo(CourseSection::class);
    }

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function attendances()
    {
        return $this->hasMany(OnlineAttendance::class);
    }

    public function getStudentsAttribute()
    {
        return $this->courseSection->enrollments()->with('student')->get()->pluck('student');
    }

    public function isLive()
    {
        return $this->status === 'live';
    }

    public function canJoin()
    {
        $now = now();
        if ($this->open_access_at && $now < $this->open_access_at) {
            return false;
        }
        if ($this->close_access_at && $now > $this->close_access_at) {
            return false;
        }
        return in_array($this->status, ['scheduled', 'live']);
    }

    public function isUpcoming()
    {
        return $this->scheduled_at > now() && $this->status === 'scheduled';
    }
}
