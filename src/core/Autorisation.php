<?php
namespace App\Core;
class Autorisation{
    //isConnect
    public static function isConnect():bool{
        return Session::get("userConnect")!=false;
    }
    //hasRole
    public static function hasRole(string $roleName):bool{
        $userConnect=Session::get("userConnect");
        if ($userConnect) {
           return $userConnect["name"]==$roleName;
        }
        return false;
    }

}