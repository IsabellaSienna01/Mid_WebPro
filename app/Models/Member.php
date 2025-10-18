<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['user_id', 'address', 'phone', 'membership_date'];
    protected $casts = ['membership_date' => 'date'];

    public function login(){
        return $this->belongsTo(Login::class, 'user_id', 'id');
    }
    public function loans(){
        return $this->hasMany(Loan::class, 'member_id', 'id');
    }

    public function bookReviews(){
        return $this->hasMany(BookReview::class, 'member_id', 'id');
    }

    public function bookRequests(){
        return $this->hasMany(BookRequest::class, 'member_id', 'id');
    }
    
}
