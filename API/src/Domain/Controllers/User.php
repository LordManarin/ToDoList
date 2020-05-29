<?php
namespace Source\Domain\Controllers;

class User{
    function showId(){
        $decoded_array = (new \Source\Domain\Controllers\TokenJwt)->decodeToken();
        return $decoded_array['sub'];
    }
}