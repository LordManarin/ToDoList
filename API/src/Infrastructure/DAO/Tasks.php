<?php
namespace Source\Infrastructure\DAO;
use Source\Controllers\User;
use Source\Domain\Models\Task;


class Tasks{
    function showTasks(){
        $userId =(new User)->showId();
        $tasks = Task::where('user_id', '=', $userId)->get();
        echo json_encode(array("response" => $tasks->all()));
    }
    function postTasks(){
        $userId= (new User)->showId();
        $data= json_decode(file_get_contents("php://input"));
        EditTasks::createTasks($data, $userId);
    }
    function deleteTask(){
        $taskId = filter_input(INPUT_GET, 'id');
        EditTasks::deleteTask($taskId);
    }
    function updateTask(){
        $data = json_decode(file_get_contents("php://input"));
        $taskId = filter_input(INPUT_GET, "id");
        EditTasks::updateTask($taskId,$data);
    }
}