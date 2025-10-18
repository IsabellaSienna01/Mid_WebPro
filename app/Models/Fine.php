<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $table = 'fines';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'loan_id',
        'amount',
        'paid',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid' => 'boolean',
    ];

    public function loan(){
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
    }
}
