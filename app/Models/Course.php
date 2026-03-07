<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'department_id',
        'code',
        'name',
        'name_en',
        'description',
        'description_en',
        'credits',
        'hours_lecture',
        'hours_lab',
        'hours_tutorial',
        'level',
        'is_active',
    ];

    protected $casts = [
        'credits' => 'integer',
        'hours_lecture' => 'integer',
        'hours_lab' => 'integer',
        'hours_tutorial' => 'integer',
        'is_active' => 'boolean',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function prerequisites()
    {
        return $this->belongsToMany(Course::class, 'course_prerequisites', 'course_id', 'prerequisite_id');
    }

    public function courseSections()
    {
        return $this->hasMany(CourseSection::class);
    }

    public function getTotalHoursAttribute()
    {
        return $this->hours_lecture + $this->hours_lab + $this->hours_tutorial;
    }
}
