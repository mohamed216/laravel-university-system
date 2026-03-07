<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'isbn',
        'title',
        'author',
        'publisher',
        'publication_year',
        'edition',
        'pages',
        'category',
        'total_copies',
        'available_copies',
        'shelf_location',
        'description',
    ];

    protected $casts = [
        'total_copies' => 'integer',
        'available_copies' => 'integer',
        'publication_year' => 'integer',
        'pages' => 'integer',
    ];

    public function transactions()
    {
        return $this->hasMany(LibraryTransaction::class);
    }

    public function isAvailable()
    {
        return $this->available_copies > 0;
    }

    public function borrow($studentId)
    {
        if (!$this->isAvailable()) {
            return false;
        }

        $transaction = LibraryTransaction::create([
            'book_id' => $this->id,
            'student_id' => $studentId,
            'checkout_date' => now(),
            'due_date' => now()->addDays(14),
            'status' => 'borrowed',
        ]);

        $this->decrement('available_copies');

        return $transaction;
    }
}
