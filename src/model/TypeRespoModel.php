<?php
namespace App\Models;
use App\Core\Model;
class TypeRespoModel extends Model{ 
    public function __construct(){
        $this->ouvrirConnexion();
        $this->table="typerespo";

    }
public function findAll(): array
    {
        return $this->executeSelect('SELECT * FROM  typerespo c');
    }

public function save(array $type): int
{
        extract($type);
        return $this->executeUpdate( "INSERT INTO `typerespo` (`nomType`) VALUES ('$nomType');");      
}

public function findByNameType(string $nameType):array|false
    {
        return $this->executeSelect("SELECT * FROM $this->table where nomType like '$nameType'",true);
    }

}

