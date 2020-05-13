<?php
use Source\Models\Tarefa;
use Source\Models\Validations;
require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . "/../config.php";
require __DIR__ . "/../Models/Tarefa.php";
require __DIR__ . "/../Models/Validations.php";

public function DeletaTarefas($request, $response){
    $data = json_decode(file_get_contents("php://input"));
    // se nao forem enviados dados, vai apresentar esta mensagem de erro
    if (!$data) {
        header("HTTP/1.1 400 BAD REQUEST");
        echo json_encode(array("response" => "Nenhum dado informado"));
        exit;
    }
    $errors = array();
    // testa se todos os campos estao preenchidos
    if (!Validations::validationInteger($data->usuario_id)) {
        array_push($errors, "usuario_id invalido");
    }
    if (count($errors) > 0) {
        header("HTTP/1.1 400  BAD REQUEST");
        echo json_encode(array("responde" => "Campos invalidos!", "fields" => $errors));
        exit;
    }
    // captura o ID da tarefa
    $tarefaId=filter_input(INPUT_GET,"tarefa_id");
    //verifica se a terefa existe
    if(!$tarefaId){
        header("HTTP/1.1 400  BAD REQUEST");
        echo json_encode(array("responde"=>"ID não informado"));
        exit;
    }
    $tarefa = (new Tarefa())->findById($tarefaId);
    if(! $tarefa){
        header("HTTP/1.1 201 Sucess");
        echo json_encode(array("response" => "Nenhuma tarefa localizada"));
        exit;
    }
    // se foi localizado a tarefa, será deletado
    $verify =  $tarefa->destroy();
    if( $tarefa->fail()){
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array("response"=> $tarefa->fail()->getMessage()));
        exit;
    }
    if($verify) {
        //caso delete a tarefa, apresentara esta mensagem
        header("HTTP/1.1 201 Sucess");
        echo json_encode(array("response" => "Tarefa Deletada"));
    }else{
        // caso nao delete a tarefa, apresentará este erro
        header("HTTP/1.1 201 Sucess");
        echo json_encode(array("response" => "Nenhuma tarefa pode ser deletada"));
    }
    return $response;

};
