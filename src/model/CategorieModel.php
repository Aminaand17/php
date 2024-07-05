<?php
namespace App\Models;
use App\Core\Model;
class CategorieModel extends Model{ 
    public function __construct(){
        $this->ouvrirConnexion();
        $this->table="categorie";
    }
    public function findAll(): array
    {
       return $this->executeSelect('SELECT * FROM categorie c' ); 
    } 
    public function save(array $categorie): int
    {
        // Extraction de la valeur de la clé 'nomCategorie'
        $nomCategorie = $categorie['nomCategorie'];
    
        // Exécution de la requête d'insertion dans la base de données
        return $this->executeUpdate("INSERT INTO `categorie` (`nomCategorie`) VALUES ('$nomCategorie');");
    }
    
    } 
?>

