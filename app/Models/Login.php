<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;


class Login extends Model implements AuthenticatableContract
{
    use Authenticatable;

    protected $table = 'users_cred';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable=['name', 'email', 'password', 'role', 'logged_in'];

    protected $hidden = ['password'];
    protected $casts = ['logged_in' => 'boolean'];

    public function member()
    {
        return $this->hasOne(Member::class, 'user_id', 'id');
    }
}
