<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    protected $table = 'book_requests';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'member_id',
        'title',
        'author',
        'publisher',
        'reason',
        'status',
    ];

    public function member(){
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
