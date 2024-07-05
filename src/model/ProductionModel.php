<?php
namespace App\Models;

use App\Core\Model;
use App\Core\Session;

class ProductionModel extends Model {
    
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table = "production";
    }

    public function save(array $data): int {
        $date = new \DateTime();
        $date = $date->format('Y-m-d');
        $userId = Session::get('userConnect')['id'];
        $qte = $data['qte'];
        $observation = isset($data['observation']) ? $data['observation'] : '';
        $articleId = $data['articleId'];
        $this->executeUpdate("INSERT INTO `production` (`date`, `qte`, `observation`, `articleId`, `userId`) VALUES ('$date', $qte, '$observation', $articleId, $userId);");

        return $this->pdo->lastInsertId();
    }

    public function findAll(): array {
        $query = "SELECT p.*, a.libelle AS articleLibelle 
                  FROM `production` p
                  LEFT JOIN `article` a ON p.articleId = a.id";
        return $this->executeSelect($query);
    }

    public function findByDate(string $date): array {
        $query = "SELECT p.*, a.libelle AS articleLibelle 
                  FROM `production` p
                  LEFT JOIN `article` a ON p.articleId = a.id
                  WHERE DATE(p.date) = '$date'";
        return $this->executeSelect($query);
    }

    public function findByArticle(int $articleId): array {
        $query = "SELECT p.*, a.libelle AS articleLibelle 
                  FROM `production` p
                  LEFT JOIN `article` a ON p.articleId = a.id
                  WHERE p.articleId = $articleId";
        return $this->executeSelect($query);
    }

    public function archiver(int $id): int {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    
    public function update(array $data): bool {
        $query = "UPDATE $this->table SET date=:date, qte=:qte, observation=:observation WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':date', $data['date']);
        $stmt->bindValue(':qte', $data['qte']);
        $stmt->bindValue(':observation', $data['observation']);
        $stmt->bindValue(':id', $data['id'], \PDO::PARAM_INT);
        return $stmt->execute();
    }
    
}
?>
