<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Grade extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'enrollment_id',
        'semester_id',
        'letter_grade',
        'percentage',
        'grade_points',
        'notes',
        'submission_date',
    ];

    protected $casts = [
        'percentage' => 'float',
        'grade_points' => 'float',
        'submission_date' => 'date',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public static function getGradePoints($letterGrade)
    {
        $grades = [
            'A+' => 4.0, 'A' => 4.0, 'A-' => 3.7,
            'B+' => 3.3, 'B' => 3.0, 'B-' => 2.7,
            'C+' => 2.3, 'C' => 2.0, 'C-' => 1.7,
            'D+' => 1.3, 'D' => 1.0, 'D-' => 0.7,
            'F' => 0.0,
        ];
        return $grades[$letterGrade] ?? 0.0;
    }
}
