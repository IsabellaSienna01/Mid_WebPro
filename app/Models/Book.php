<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['title','author','publisher','year','stock','description','category_id', 'image'];

    protected $casts = [
        'year' => 'integer',
        'stock' => 'integer',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function bookReviews(){
        return $this->hasMany(BookReview::class, 'book_id', 'id');
    }
}
