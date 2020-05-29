<?php
namespace Source\Domain\Models;
use Source\Domain\Models\ValidateInfos;
use Source\Controllers\User;

class EditTasks{
    public static function createTasks($data, $userId)
    {
        $validate = ValidateInfos::ValidateData($data);
        if ($validate) {
            $task = new Task();
            $task->user_Id = $userId;
            $task->task = $data->task;
            $task->description = $data->description;
            $task->done = $data->done;
            $task->save();
            return json_encode(array("response" => "Tarefa Criada com Sucesso"));
        }

    }
    public static function updateTask($taskId,$data){
        $validate = ValidateInfos::ValidateData($data);
        if($validate) {
            $task = Task::find($taskId);
            $task->task = $data->task;
            $task->description = $data->description;
            $task->done = $data->done;
            $task->save();
            return json_encode(array("response" => "Tarefa Atualizada"));
        }
    }
    public static function deleteTask($taskId){
        if(!$taskId) {
            echo json_encode(array("response" => "Nenhuma tarefa localizada"));
            exit;
        }
        $task= Task::destroy($taskId);
        if($task) {
            return json_encode(array("response" => "Tarefa removida com sucesso!"));
        }else{
            return json_encode(array("response" => "Nenhuma tarefa removida"));
        }
    }
}

