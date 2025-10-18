<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'member_id',
        'loan_date', 
        'due_date', 
        'return_date',
        'fine',
        'status',
    ];

    protected $casts = [
        'loan_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
        'fine' => 'decimal:2',
    ];

    public function member(){
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
    public function loanDetails(){
        return $this->hasMany(LoanDetail::class, 'loan_id', 'id');
    }

    public function fines(){
        return $this->hasMany(Fine::class, 'loan_id', 'id');
    }

}
