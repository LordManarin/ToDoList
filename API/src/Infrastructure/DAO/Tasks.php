<?php
namespace Source\Infrastructure\DAO;
use Source\Domain\Controllers\User;
use Source\Domain\Models\Task;

class Tasks{
   public $userId;

   public function __construct(){
       $this->userId = (new User)->showId();
   }

    function showTasks(){
        $userId= $this->userId;
        $tasks = Task::where('user_id', '=', $userId)->get();
        echo json_encode(array("response" => $tasks->all()));
    }
    function postTasks(){
        $userId= $this->userId;
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