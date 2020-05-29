<?php


namespace Source\Infrastructure\Middlewares;
use Source\Models\Validations;

class ValidationsMiddleware{
    function validateData(){
        $data= json_decode(file_get_contents("php://input"));
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
            header("HTTP/1.1 400  BAD REQUEST");
            echo json_encode(array("responde"=>"Campos invalidos!", "fields"=>$errors));
            exit;
        }
        if(count($errors)>0){
            header("HTTP/1.1 400  BAD REQUEST");
            echo json_encode(array("responde"=>"Campos invalidos!", "fields"=>$errors));
            exit;
        }
        return $data;
    }

}