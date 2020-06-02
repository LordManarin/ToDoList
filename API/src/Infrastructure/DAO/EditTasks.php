<?php
namespace Source\Infrastructure\DAO;
use Source\Domain\Controllers\ValidateInfos;
use Source\Domain\Models\Task;

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
            echo json_encode(array("response" => "Tarefa Criada com Sucesso"));
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
            echo json_encode(array("response" => "Tarefa Atualizada"));
        }
    }
    public static function deleteTask($taskId){
        $validate = ValidateInfos::validateTaskId($taskId);
        if($validate) {
           Task::destroy($taskId);
        }
            echo json_encode(array("response" => "Tarefa removida com sucesso!"));
        }


    public static function showTasks($userId){
        $tasks = Task::where('user_id', '=', $userId)->get();
        echo json_encode(array("response" => $tasks->all()));
    }
}

