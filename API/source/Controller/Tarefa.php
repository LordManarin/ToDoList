<?php
namespace Source\Controllers;
use Source\Models\Tarefa;
use Source\Models\Validations;

require "../../vendor/autoload.php";
require "../Config.php";

// constantes que definem se será add, atualizado ou deletado as tarefas
const ADICIONANDO=1;
const ATUALIZANDO=2;
const DELETANDO=3;

// Metodo POST
switch ($_SERVER["REQUEST_METHOD"]){
    case "POST":
        // verifica se será add, atualizado ou deletado as tarefas
        $verifica = filter_input(INPUT_GET,"informa");
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
            array_push($errors, "Invalido");
        }
        if(count($errors)>0){
            header("HTTP/1.1 400  BAD REQUEST");
            echo json_encode(array("responde"=>"Campos invalidos!", "fields"=>$errors));
            exit;
        }
        // acrescenta dados
        if($verifica==ADICIONANDO) {
            // se tudo OK, envia os dados para o DB
            $tarefa = new Tarefa();
            $tarefa->usuario_id = $data->usuario_id;
            $tarefa->tarefa = $data->tarefa;
            $tarefa->descricao = $data->descricao;
            $tarefa->concluido = $data->concluido;
            $tarefa->save();
            // se der ERRO no DB, informa esta msg de erro
            if ( $tarefa->fail()) {
                header("HTTP/1.1 500 Internal Server Error");
                echo json_encode(array("response" =>  $tarefa->fail()->getMessage()));
                exit;
            }
            // se der tudo certo, informa esta mensagem
            header("HTTP/1.1 200 CREATED");
            echo json_encode(array("response" => "Tarefa Criada com Sucesso"));
            break;
        }
        // ATUALIZAR DADOS
        if($verifica==ATUALIZANDO) {
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
            break;
        }

        // DELETAR
        if($verifica==DELETANDO) {
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
                // caso nao dele a tarefa, apresentará este erro
                header("HTTP/1.1 201 Sucess");
                echo json_encode(array("response" => "Nenhuma tarefa pode ser deletada"));
            }
            break;
        }
        break;

    // Consulta
    case "GET":
        header("HTTP/1.1 200 ok");
        $tarefas = new Tarefa();
        if( $tarefas->find()->Count()>0){
            $return = array();
            foreach ( $tarefas->find()->fetch(true) as  $tarefa){
                // tratamento de dados
                array_push($return, $tarefa->data());
            }
            echo json_encode(array("response"=>$return));
        }else{
            echo json_encode(array("response"=>"Sem tarefas cadastradas"));
        }
        break;
    // se tentar utilizar outro metodo nao configurado, apresenta esta mensagem de erro
    default;
        header("HTTP/1.1 401 UNAUTHORIZED");
        echo json_encode(array("response"=>"Metodo nao previsto"));
        break;
}

