<?php
namespace Source\Controllers;

class User{
    function showId(){
        $decoded_array = (new \Source\Controllers\TokenJwt)->decodeToken();
        return $decoded_array['sub'];
    }
}