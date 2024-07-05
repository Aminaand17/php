<?php
namespace App\Models;
use App\Core\Model;
class UserModel extends Model{
    public function __construct(){
        $this->ouvrirConnexion();
        $this->table="user";
    }
    public function finByLoginAndPassword(string $login, string $password): array|false
{
    return $this->executeSelect("SELECT u.*, r.name FROM $this->table u JOIN role r ON u.roleId = r.id WHERE u.login = '$login' AND u.password like '$password'",true);
}

}