<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'course_section_id',
        'date',
        'time_in',
        'time_out',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'time_in' => 'datetime:H:i',
        'time_out' => 'datetime:H:i',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function courseSection()
    {
        return $this->belongsTo(CourseSection::class);
    }

    public static function getAttendanceRate($studentId, $courseSectionId)
    {
        $total = static::where('student_id', $studentId)
            ->where('course_section_id', $courseSectionId)
            ->count();
        
        if ($total === 0) return 0;
        
        $present = static::where('student_id', $studentId)
            ->where('course_section_id', $courseSectionId)
            ->whereIn('status', ['present', 'late'])
            ->count();
            
        return round(($present / $total) * 100, 2);
    }
}
