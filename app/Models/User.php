<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = "id_user";
    protected $guard = 'user';
    protected $table = "user";
    public function getAuthPassword()
    {
        return bcrypt($this->passwordUser);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function getUser() {
        return User::select('*')
        ->get();

    }
    public function getUserWhere($where) {
        return User::select('*')
        ->where($where)
        ->get();

    }

    public function firstUser($where) {
        return User::select('*')
        ->where($where)
        ->first();
    }
    public function insertUser($data){
        return User::insert($data);
    }
}
