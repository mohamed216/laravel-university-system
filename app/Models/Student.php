<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'department_id',
        'academic_year_id',
        'student_id',
        'first_name',
        'first_name_en',
        'last_name',
        'last_name_en',
        'phone',
        'birth_date',
        'national_id',
        'gender',
        'nationality',
        'address',
        'guardian_name',
        'guardian_phone',
        'guardian_relation',
        'high_school',
        'high_school_grade',
        'status',
        'current_level',
        'gpa',
        'total_credits',
        'admission_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'admission_date' => 'date',
        'high_school_grade' => 'float',
        'gpa' => 'float',
        'current_level' => 'integer',
        'total_credits' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function studentFees()
    {
        return $this->hasMany(StudentFee::class);
    }

    public function libraryTransactions()
    {
        return $this->hasMany(LibraryTransaction::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFullNameEnAttribute()
    {
        return $this->first_name_en . ' ' . $this->last_name_en;
    }
}
