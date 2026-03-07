<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'student_id',
        'student_fee_id',
        'receipt_number',
        'amount',
        'payment_method',
        'transaction_id',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function studentFee()
    {
        return $this->belongsTo(StudentFee::class);
    }

    public static function generateReceiptNumber()
    {
        $year = date('Y');
        $lastPayment = static::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();
            
        $sequence = $lastPayment ? (int)substr($lastPayment->receipt_number, -5) + 1 : 1;
        
        return 'RCP-' . $year . '-' . str_pad($sequence, 5, '0', STR_PAD_LEFT);
    }
}
