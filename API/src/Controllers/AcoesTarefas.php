<?php
namespace Source\Controllers;
require __DIR__. "/../../vendor/autoload.php";

use Firebase\JWT\JWT;
use Source\Models\Validations;
use Source\Models\Tarefa;

class AcoesTarefas{
    function exibe(){
        $jwt = $_SESSION['token'];
        $tokenDecode= JWT::decode($jwt,"abcde",array('HS256'));
        $tokenDecodeArray = array($tokenDecode);
        $usuarioId=$tokenDecodeArray[2];



        header("HTTP/1.1 200 Ok");
        // filtra os resultados para exibir somente as tarefas do usuario
        $tarefas = Tarefa::where('usuario_id', '=', $usuarioId)->get();
        $return = array();
        array_push($return, $tarefas->all());
        // exibe as tarefas do usuario
        echo json_encode(array("response" => $return));
    }
    function cria(){
        //$usuarioId = $_SESSION['usuario_Id'];
        $token = $_SESSION['token'];
        $token->getAttribute("token");
        $usuarioId = $token["sub"];
        $data= json_decode(file_get_contents("php://input"));
        // se nao forem enviados dados, vai apresentar esta mensagem de erro
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
        // se tudo OK, envia os dados para o DB
        $tarefa = new Tarefa();
        $tarefa->usuario_id = $usuarioId;
        $tarefa->tarefa = $data->tarefa;
        $tarefa->descricao = $data->descricao;
        $tarefa->concluido = $data->concluido;
        $tarefa->save();
        // se der tudo certo, informa esta mensagem
        header("HTTP/1.1 200 CREATED");
        echo json_encode(array("response" => "Tarefa Criada com Sucesso"));
    }

    function deleta(){
        $tarefaId = filter_input(INPUT_GET, 'id');
        if(!$tarefaId){
            header("HTTP/1.1 201 Sucess");
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

    function atualiza(){
        $data = json_decode(file_get_contents("php://input"));
        // se nao forem enviados dados, vai apresentar esta mensagem de erro
        if (!$data) {
            header("HTTP/1.1 400 BAD REQUEST");
            echo json_encode(array("response" => "Nenhum dado informado"));
            exit;
        }
        $errors = array();
        // testa se todos os campos estao preenchidos

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
        // captura o ID da tarefa
        $tarefaId = filter_input(INPUT_GET, "id");
        //verifica se a tarefa existe
        if (!$tarefaId) {
            header("HTTP/1.1 400  BAD REQUEST");
            echo json_encode(array("responde" => "ID não informado"));
            exit;
        }
        //$tarefa = (new Tarefa())->findById($tarefaId);
        if (count($errors)>0) {
            header("HTTP/1.1 201");
            echo json_encode(array("response" => "Nenhuma tarefa localizada"));
            exit;
        }
        // informa os novos dados ao banco de dados
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