<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = ['name','description',];


    public function books()
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
