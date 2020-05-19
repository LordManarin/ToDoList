<?php
use Slim\App;
use Source\Models\Tarefa;
use Source\Models\Validations;
require __DIR__ . '/../../vendor/autoload.php';

function PostaTarefa($response){
    $app = new App;
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
    // se tudo OK, envia os dados para o DB
    $tarefa = new Tarefa();
    $tarefa->usuario_id = $data->usuario_id;
    $tarefa->tarefa = $data->tarefa;
    $tarefa->descricao = $data->descricao;
    $tarefa->concluido = $data->concluido;
    $tarefa->save();
    if ( $tarefa->fail()) {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(array("response" =>  $tarefa->fail()->getMessage()));
        exit;
    }
    // se der tudo certo, informa esta mensagem
    header("HTTP/1.1 200 CREATED");
    echo json_encode(array("response" => "Tarefa Criada com Sucesso"));
    return $response;
};