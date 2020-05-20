<?php
namespace Source\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

class Tarefa extends Eloquent{
    public $timestamps = false;
    protected $table = 'tarefas';
    protected $fillable = [
        "tarefa_id",
        "usuario_id",
        "tarefa",
        "descricao",
        "concluido",

    ];
}