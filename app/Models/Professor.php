<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Professor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'department_id',
        'employee_id',
        'first_name',
        'first_name_en',
        'last_name',
        'last_name_en',
        'phone',
        'birth_date',
        'specialization',
        'degree',
        'qualifications',
        'office',
        'office_hours',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function courseSections()
    {
        return $this->hasMany(CourseSection::class);
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
