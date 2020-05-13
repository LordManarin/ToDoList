<?php
namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Tarefa extends DataLayer{

    public function __construct()
    {
        parent::__construct("tarefas",["usuario_id","tarefa","descricao","concluido"],"tarefa_id", false);
    }
}