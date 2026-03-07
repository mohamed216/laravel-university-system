<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'book_id',
        'student_id',
        'checkout_date',
        'due_date',
        'return_date',
        'status',
        'renewal_count',
        'notes',
    ];

    protected $casts = [
        'checkout_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
        'renewal_count' => 'integer',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function isOverdue()
    {
        return $this->status === 'borrowed' && $this->due_date->isPast();
    }

    public function returnBook()
    {
        $this->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        $this->book->increment('available_copies');
    }

    public function renew($days = 14)
    {
        $this->update([
            'due_date' => $this->due_date->addDays($days),
            'renewal_count' => $this->renewal_count + 1,
        ]);
    }
}
