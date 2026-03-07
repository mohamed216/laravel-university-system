<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faculty extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_en',
        'code',
        'description',
        'description_en',
        'dean_name',
        'email',
        'phone',
        'building',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function students()
    {
        return $this->hasManyThrough(Student::class, Department::class);
    }

    public function professors()
    {
        return $this->hasManyThrough(Professor::class, Department::class);
    }
}
