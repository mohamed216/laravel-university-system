<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'academic_year_id',
        'name',
        'type',
        'amount',
        'description',
        'is_per_credit',
        'is_mandatory',
        'due_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'is_per_credit' => 'boolean',
        'is_mandatory' => 'boolean',
        'due_date' => 'date',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function studentFees()
    {
        return $this->hasMany(StudentFee::class);
    }
}
