<?php
namespace Source\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Users extends eloquent{
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = [
        "id",
        "user_id",
        "email",
        "passwd"
    ];
}