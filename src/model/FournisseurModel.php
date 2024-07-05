<?php
namespace App\Models;

use App\Core\Model;

class FournisseurModel extends Model
{
    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table = "fournisseur";
    }

    public function findByTel(string $tel): array|false
    {
        return $this->executeSelect("SELECT * FROM $this->table WHERE telFour LIKE '$tel'", true);
    }

    public function save(array $data): int
    {
        try {
            $nomComplet = $data['nomFour'] ?? '';
            $telephone = $data['telFour'] ?? '';
            $adresse = $data['adresseFour'] ?? '';

            $stmt = $this->pdo->prepare("INSERT INTO fournisseur (nomFour, telFour, adresseFour) VALUES (?, ?, ?)");
            $stmt->execute([$nomComplet, $telephone, $adresse]);
            
            return $this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            error_log('Erreur de connexion : ' . $e->getMessage());
            throw new \PDOException('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public function update(array $data): int {
        extract($data);
        return $this->executeUpdate("UPDATE $this->table SET nomFour='$nomFour', telFour='$telFour', adresseFour='$adresseFour' WHERE id=$id");
    }
    

    public function archiver(int $id): int {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
    

}
?>
