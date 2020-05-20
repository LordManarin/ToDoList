<?php
namespace Source\Controllers;
use Source\Models\Validations;
use Source\Models\Tarefa;
require __DIR__ . '/../../vendor/autoload.php';

class DeletaTarefas{

    function DeletaTarefas()
    {
        $id = filter_input(INPUT_GET, 'tarefa_id');

        $tarefa = \tarefa::destroy($id);


    }
}