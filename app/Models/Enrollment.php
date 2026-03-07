<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'course_section_id',
        'semester_id',
        'status',
        'enrollment_date',
        'drop_date',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'drop_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function courseSection()
    {
        return $this->belongsTo(CourseSection::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function isPassed()
    {
        return $this->status === 'completed';
    }
}
