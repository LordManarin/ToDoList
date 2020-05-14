<?php
use Slim\Factory\AppFactory;
use Source\Models\Tarefa;
use Source\Models\Validations;
require __DIR__ . '/../../vendor/autoload.php';

function AtualizaTarefas($response){
    $app = AppFactory::create();
    $data= json_decode(file_get_contents("php://input"));
    // se nao forem enviados dados, vai apresentar esta mensagem de erro
    if(!$data){
        header("HTTP/1.1 400 BAD REQUEST");
        echo json_encode(array("response"=>"Nenhum dado informado"));
        exit;
    }
    $errors=array();
    // testa se todos os campos estao preenchidos
    if(!Validations::validationInteger($data->usuario_id)) {
        array_push($errors, "usuario_id invalido");
    }
    if(!Validations::validationsString($data->tarefa)){
        array_push($errors, "Tarefa invalido");
    }
    if(!Validations::validationsString($data->descricao)){
        array_push($errors, "Descrição invalido");
    }
    if(!Validations::validationsString($data->concluido)){
        array_push($errors, "Estado Invalido");
    }
    if(count($errors)>0){
        header("HTTP/1.1 400  BAD REQUEST");
        echo json_encode(array("responde"=>"Campos invalidos!", "fields"=>$errors));
        exit;
    }
    // captura o ID da tarefa
    $tarefaId=filter_input(INPUT_GET,"tarefa_id");
    //verifica se a tarefa existe
    if(!$tarefaId){
        header("HTTP/1.1 400  BAD REQUEST");
        echo json_encode(array("responde"=>"ID não informado"));
        exit;
    }
    $tarefa = (new Tarefa())->findById($tarefaId);
    if(!$tarefa){
        header("HTTP/1.1 201 Sucess");
        echo json_encode(array("response" => "Nenhuma tarefa localizada"));
        exit;
    }
    // informa os novos dados ao banco de dados
    $tarefa = (new Tarefa())->findById($tarefaId);
    $tarefa->tarefa= $data->tarefa;
    $tarefa->descricao= $data->descricao;
    $tarefa->concluido= $data->concluido;
    $tarefa->save();
    //caso ocorra erro com o banco de dados
    if( $tarefa->fail()){
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array("response"=> $tarefa->fail()->getMessage()));
        exit;
    }
    // caso tudo ocorra bem
    header("HTTP/1.1 201 Sucess");
    echo json_encode(array("response"=>"Tarefa Atualizada"));
    return $response;
};
