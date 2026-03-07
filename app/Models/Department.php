<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'faculty_id',
        'name',
        'name_en',
        'code',
        'description',
        'description_en',
        'head_name',
        'email',
        'phone',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function professors()
    {
        return $this->hasMany(Professor::class);
    }
}
