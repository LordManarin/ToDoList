<?php
namespace Source\Domain\Controllers;
use Source\Models\Validations;

class ValidateInfos{
    public static function ValidateData($data)
    {
        if(!$data){
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
            print json_encode(array("responde"=>"Campos invalidos!", "fields"=>$errors));
            exit;
        }else{
            return $data;
        }
    }

    public static function validateTaskId($taskId){
        if(!$taskId) {
            echo json_encode(array("response" => "Nenhuma tarefa localizada"));
            exit;
        }else{
            return $taskId;
        }
    }


}