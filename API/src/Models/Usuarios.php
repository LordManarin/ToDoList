<?php

namespace Source\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Usuarios extends eloquent{
    public $timestamps = false;
    protected $table = 'usuarios';
    protected $fillable = [
        "usuario_id",
        "usuario",
        "senha"
    ];
}