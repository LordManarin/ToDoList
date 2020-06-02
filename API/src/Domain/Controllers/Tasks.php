<?php
namespace Source\Domain\Controllers;
use Source\Infrastructure\DAO\EditTasks;

class Tasks{
   public $userId;
   public $data;
   public $taskId;

    public function __construct(){
       $this->userId = (new User)->showId();
       $this->data = json_decode(file_get_contents("php://input"));
       $this->taskId=filter_input(INPUT_GET, 'id');
    }
    function showTasks(){
        $userId= $this->userId;
        EditTasks::showTasks($userId);
    }
    function postTasks(){
        $userId= $this->userId;
        $data= $this->data;
        EditTasks::createTasks($data, $userId);
    }
    function deleteTask(){
        $taskId = $this->taskId;
        EditTasks::deleteTask($taskId);
    }
    function updateTask(){
        $data= $this->data;
        $taskId = $this->taskId;
        EditTasks::updateTask($taskId,$data);
    }
}