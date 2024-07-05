<?php
use App\Core\Session;
use App\Core\Autorisation;
function add_class_invalid(string $fielName):void{
    echo isset(Session::get("errors")[$fielName])? "is-invalid":"";
}
function add_class_hidden(string $fielName):void{
    echo !isset(Session::get("errors")[$fielName])? "visually-hidden":"";
}
function has_role(string $roleName):void{
    echo !Autorisation::hasRole($roleName)? "visually-hidden":"";
}

function add_class_hidden_lien(string $roleName): void {
    // Vérifier si l'utilisateur connecté a le rôle nécessaire
    if (!Autorisation::hasRole($roleName)) {
        echo "Visually-hidden";
    }
}

function dd(mixed $data){
    dump($data);die;
}

function dump(mixed $data){
    echo "<pre>";
    var_dump($data);
    echo "<pre>";

}