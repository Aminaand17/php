<?php

namespace App\Models;
use App\Core\Model;
class ArticleModel extends Model{
public function __construct(){
    $this->ouvrirConnexion();
    
}

public function findById(int $id): array
{
    $sql = "SELECT a.*, c.nomCategorie, t.nomType 
            FROM article a 
            INNER JOIN categorie c ON a.categorieId = c.id 
            INNER JOIN type t ON a.typeId = t.id 
            WHERE a.id = :id";

    try {
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        // Récupérer les résultats sous forme de tableau associatif
        $article = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $article ? $article : []; // Retourner l'article trouvé ou un tableau vide si aucun résultat trouvé
    } catch (\PDOException $e) {
        // Gérer les erreurs de requête SQL
        echo "Erreur de requête : " . $e->getMessage();
        return []; // Retourner un tableau vide en cas d'erreur
    }
}


public function findAllWithPaginate(int $page=0,int $offset=2): array
{
    $result=$this->executeSelect("SELECT count(*) as nbreArticle FROM `article`",true);
    $data= $this->executeSelect("SELECT a.*, c.nomCategorie, t.nomType FROM `article` a INNER JOIN categorie c ON a.categorieId = c.id INNER JOIN type t ON a.typeId = t.id Limit $page,$offset;");

    return[
        "totalElements"=>$result['nbreArticle'],
        "data"=>$data,
        "pages"=>ceil($result['nbreArticle']/$offset)
    ];
} 


public function findAll(): array
{

    return $this->executeSelect("SELECT a.*, c.nomCategorie, t.nomType FROM `article` a INNER JOIN categorie c ON a.categorieId = c.id INNER JOIN type t ON a.typeId = t.id ;");
}

public function save(array $data): int
{
    try {
        $libelle = $data['libelle'] ?? '';
        $qteStock = $data['qteStock'] ?? '';
        $prix = $data['prixAppro'] ?? '';
        $typeId = $data['typeId'] ?? '';
        $categorieId = $data['categorieId'] ?? ''; 

        $stmt = $this->pdo->prepare("INSERT INTO `article` (`libelle`, `qteStock`, `prixAppro`, `typeId`, `categorieId`) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$libelle, $qteStock, $prix, $typeId, $categorieId]);

        return $this->pdo->lastInsertId();
    } catch (\PDOException $e) {
        error_log('Erreur de connexion : ' . $e->getMessage());
        throw new \PDOException('Erreur de connexion : ' . $e->getMessage());
    }
}



}
?>
