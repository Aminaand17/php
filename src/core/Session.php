<?php
namespace App\Core;
class Session{
    //1 ouvrir
    public static function ouvrir(){
        if (session_status()==PHP_SESSION_NONE){
            session_start();//$_SESSION
        }
        
    }
    //Ajouter des donnees
    public static function add(string $key,mixed $data){
        $_SESSION[$key]=$data;
    }

    //detruire les donnee de la session
    public static function remove(string $key):bool{
       if(isset($_SESSION[$key])){
        unset($_SESSION[$key]);
        return true;
       }
       return false;
    }
    //detruire les donnee de la session
    public static function get(string $key):mixed{
        if(isset($_SESSION[$key])){
         return $_SESSION[$key];
        }
        return false;
     }


    //2 fermer la session 
    public static function fermer(){
        //1 detruire les donnee de la session
            unset($_SESSION["userConnect"]);
            session_destroy();//$_SESSION
        }

}