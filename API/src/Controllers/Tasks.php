<?php
namespace Source\Controllers;
use Source\Models\Validations;
use Source\Domain\Models\Task;

class Tasks{
    function ShowTasks(){
        $jwt = $_SESSION['Token'];
        $tokenParts = explode('.', $jwt);
        $payload = base64_decode($tokenParts[1]);
        $userId=$payload[7];
        header("HTTP/1.1 200 Success");
        $tasks = Task::where('user_id', '=', $userId)->get();
        $return = array();
        array_push($return, $tasks->all());
        echo json_encode(array("response" => $return));
    }
    function CreateTasks(){
        $jwt = $_SESSION['token'];
        $tokenParts = explode('.', $jwt);
        $payload = base64_decode($tokenParts[1]);
        $userId=$payload[7];
        $data= json_decode(file_get_contents("php://input"));
        if(!$data){
            header("HTTP/1.1 400 BAD REQUEST");
            echo json_encode(array("response"=>"Nenhum dado informado"));
            exit;
        }
        $errors=array();
        if(!Validations::validationsString($data->task)){
            array_push($errors, "Tarefa invalida");
        }
        if(!Validations::validationsString($data->description)){
            array_push($errors, "Descrição invalido");
        }
        if(!Validations::validationsString($data->done)){
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
        $task = new Task();
        $task->user_Id = $userId;
        $task->task = $data->task;
        $task->description = $data->description;
        $task->done = $data->done;
        $task->save();
        header("HTTP/1.1 200 CREATED");
        echo json_encode(array("response" => "Tarefa Criada com Sucesso"));
    }

    function DeleteTask(){
        $taskId = filter_input(INPUT_GET, 'id');
        if(!$taskId){
            header("HTTP/1.1 201 Success");
            echo json_encode(array("response" => "Nenhuma tarefa localizada"));
            exit;
        }
        $task= Task::destroy($taskId);
        if($task) {
            header("HTTP/1.1 200 Ok");
            echo json_encode(array("response" => "Tarefa removida com sucesso!"));
        }else{
            header("HTTP/1.1 200 Ok");
            echo json_encode(array("response" => "Nenhuma tarefa removida"));
        }
    }

    function UpdateTask(){
        $data = json_decode(file_get_contents("php://input"));
        if (!$data) {
            header("HTTP/1.1 400 BAD REQUEST");
            echo json_encode(array("response" => "Nenhum dado informado"));
            exit;
        }
        $errors = array();

        if(!Validations::validationsString($data->task)){
            array_push($errors, "Tarefa invalida");
        }
        if(!Validations::validationsString($data->description)){
            array_push($errors, "Descrição invalido");
        }
        if(!Validations::validationsString($data->done)){
            array_push($errors, "Estado Invalido");
        }
        if (count($errors) > 0) {
            header("HTTP/1.1 400  BAD REQUEST");
            echo json_encode(array("responde" => "Campos invalidos!", "fields" => $errors));
            exit;
        }
        $taskId = filter_input(INPUT_GET, "id");
        if (!$taskId) {
            header("HTTP/1.1 400  BAD REQUEST");
            echo json_encode(array("responde" => "ID não informado"));
            exit;
        }
        if (count($errors)>0) {
            header("HTTP/1.1 201");
            echo json_encode(array("response" => "Nenhuma tarefa localizada"));
            exit;
        }
        $taskId = filter_input(INPUT_GET, "id");
        $task = Task::find($taskId);
        $task->task = $data->task;
        $task->description = $data->description;
        $task->done = $data->done;
        $task->save();
        // caso tudo ocorra bem
        header("HTTP/1.1 201 Success");
        echo json_encode(array("response" => "Tarefa Atualizada"));
    }
}