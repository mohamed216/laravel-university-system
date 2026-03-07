<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseSection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_id',
        'semester_id',
        'professor_id',
        'section_number',
        'capacity',
        'enrolled_count',
        'room',
        'schedule',
        'status',
    ];

    protected $casts = [
        'capacity' => 'integer',
        'enrolled_count' => 'integer',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function professor()
    {
        return $this->belongsTo(Professor::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function isFull()
    {
        return $this->enrolled_count >= $this->capacity;
    }
}
