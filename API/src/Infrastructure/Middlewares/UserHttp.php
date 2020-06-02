<?php

namespace Source\Domain\Infrastructure\DAO;

use Source\Domain\Models\Users;

class UserHttp{
    public function getUser($httpHeader){
        $header = explode(" ",$httpHeader);
        $headerExploded = $header[1];
        $headerDecoded = base64_decode($headerExploded);
        $userInfos = explode(":", $headerDecoded);
        return $userInfos[0];
    }
    public function getPasswd($httpHeader){
        $header = explode(" ", $httpHeader);
        $headerExploded = $header[1];
        $headerDecoded = base64_decode($headerExploded);
        $userInfos = explode(":", $headerDecoded);
        return $userInfos[1];
    }
    public function VerifyUser($user,$passwd){

        $verifyUser = Users::where('user', '=', $user)->value("user");
        $verifyPasswd = Users::where('user', '=', $user)->value("passwd");
        $_SESSION['ID'] = Users::where('user', '=', $user)->value("user_id");
        $_SESSION['Name'] = Users::where('user', '=', $user)->value("name");
        $_SESSION['User'] = $user;

        if($passwd == $verifyPasswd && $user == $verifyUser){
            return true;
        }else{
            return false;
        }
    }

}