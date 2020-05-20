<?php

use Source\Models\Tarefa;
require __DIR__ . '/../../vendor/autoload.php';


function ExibeTarefas (){

    $tarefa = Tarefa::all();

    foreach ($tarefa as $tarefa) {
        echo $tarefa;
    }




    /*
    new App;

    $usuarioId = filter_input(INPUT_GET, "usuario_id");
    header("HTTP/1.1 200 ok");
    if (!$usuarioId) {
        header("HTTP/1.1 201 Sucess");
        echo json_encode(array("response" => "Nenhuma tarefa localizada"));
        exit;
    } else {
        $usuario = new Tarefa();
        $return = array();
        foreach ($usuario->find("usuario_id =:usuario_id", "usuario_id=$usuarioId")->fetch(true) as $usuario) {
            array_push($return, $usuario->data());
        }
        echo json_encode(array("response" => $return));
    }
*/
}