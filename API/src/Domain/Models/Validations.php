<?php

namespace Source\Models;

final class Validations{
    public static function validationsString($String){
        return strlen($String)>=1;
    }
    public static function validationInteger($Integer){
        return filter_var($Integer, FILTER_VALIDATE_INT);
    }
}