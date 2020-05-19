<?php
namespace Source\Models;

class Tarefa{

    public function __construct()
    {
        parent::__construct("tarefas",["usuario_id","tarefa","descricao","concluido"],"tarefa_id", false);
    }
}