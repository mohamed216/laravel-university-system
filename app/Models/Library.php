<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'book_title',
        'book_author',
        'isbn',
        'borrow_date',
        'due_date',
        'return_date',
        'status',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
