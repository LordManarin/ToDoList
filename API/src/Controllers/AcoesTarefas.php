<?php
namespace Source\Controllers;
use Source\Models\Validations;
use Source\Models\Tarefa;

class AcoesTarefas{
    function exibeTarefas(){
        $jwt = $_SESSION['token'];
        $tokenParts = explode('.', $jwt);
        $payload = base64_decode($tokenParts[1]);
        $usuarioId=$payload[7];
        header("HTTP/1.1 200 Success");
        $tarefas = Tarefa::where('usuario_id', '=', $usuarioId)->get();
        $return = array();
        array_push($return, $tarefas->all());
        echo json_encode(array("response" => $return));
    }
    function criaTarefas(){
        $jwt = $_SESSION['token'];
        $tokenParts = explode('.', $jwt);
        $payload = base64_decode($tokenParts[1]);
        $usuarioId=$payload[7];
        $data= json_decode(file_get_contents("php://input"));
        if(!$data){
            header("HTTP/1.1 400 BAD REQUEST");
            echo json_encode(array("response"=>"Nenhum dado informado"));
            exit;
        }
        $errors=array();
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
        if(count($errors)>0){
            header("HTTP/1.1 400  BAD REQUEST");
            echo json_encode(array("responde"=>"Campos invalidos!", "fields"=>$errors));
            exit;
        }
        $tarefa = new Tarefa();
        $tarefa->usuario_id = $usuarioId;
        $tarefa->tarefa = $data->tarefa;
        $tarefa->descricao = $data->descricao;
        $tarefa->concluido = $data->concluido;
        $tarefa->save();
        header("HTTP/1.1 200 CREATED");
        echo json_encode(array("response" => "Tarefa Criada com Sucesso"));
    }

    function deletaTarefas(){
        $tarefaId = filter_input(INPUT_GET, 'id');
        if(!$tarefaId){
            header("HTTP/1.1 201 Success");
            echo json_encode(array("response" => "Nenhuma tarefa localizada"));
            exit;
        }
        $tarefa= Tarefa::destroy($tarefaId);
        if($tarefa) {
            header("HTTP/1.1 200 Ok");
            echo json_encode(array("response" => "Tarefa removida com sucesso!"));
        }else{
            header("HTTP/1.1 200 Ok");
            echo json_encode(array("response" => "Nenhuma tarefa removida"));
        }
    }

    function atualizaTarefas(){
        $data = json_decode(file_get_contents("php://input"));
        if (!$data) {
            header("HTTP/1.1 400 BAD REQUEST");
            echo json_encode(array("response" => "Nenhum dado informado"));
            exit;
        }
        $errors = array();

        if (!Validations::validationsString($data->tarefa)) {
            array_push($errors, "Tarefa invalido");
        }
        if (!Validations::validationsString($data->descricao)) {
            array_push($errors, "Descrição invalido");
        }
        if (!Validations::validationsString($data->concluido)) {
            array_push($errors, "Estado Invalido");
        }
        if (count($errors) > 0) {
            header("HTTP/1.1 400  BAD REQUEST");
            echo json_encode(array("responde" => "Campos invalidos!", "fields" => $errors));
            exit;
        }
        $tarefaId = filter_input(INPUT_GET, "id");
        if (!$tarefaId) {
            header("HTTP/1.1 400  BAD REQUEST");
            echo json_encode(array("responde" => "ID não informado"));
            exit;
        }
        if (count($errors)>0) {
            header("HTTP/1.1 201");
            echo json_encode(array("response" => "Nenhuma tarefa localizada"));
            exit;
        }
        $tarefaId = filter_input(INPUT_GET, "id");
        $tarefa = Tarefa::find($tarefaId);
        $tarefa->tarefa = $data->tarefa;
        $tarefa->descricao = $data->descricao;
        $tarefa->concluido = $data->concluido;
        $tarefa->save();
        // caso tudo ocorra bem
        header("HTTP/1.1 201 Success");
        echo json_encode(array("response" => "Tarefa Atualizada"));
    }
}