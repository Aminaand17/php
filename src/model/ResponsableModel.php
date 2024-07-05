<?php
namespace App\Models;

use App\Core\Model;

class ResponsableModel extends Model {
    public function __construct() {
        $this->ouvrirConnexion();
        $this->table = "responsable";
    }

    public function save(array $data): int {
        try {
            $nomComplet = $data['nomComplet'] ?? '';
            $telephone = $data['telephone'] ?? '';
            $adresse = $data['adresse'] ?? '';
            $salaire = $data['salaire'] ?? '';
            $idRespo = $data['idRespo'] ?? '';

            $stmt = $this->pdo->prepare("INSERT INTO responsable (nomComplet, telephone, adresse, salaire, idRespo) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nomComplet, $telephone, $adresse, $salaire, $idRespo]);

            return $this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            error_log('Erreur de connexion : ' . $e->getMessage());
            throw new \PDOException('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public function update(array $data): int {
        extract($data);
        return $this->executeUpdate("UPDATE $this->table SET nomComplet='$nomComplet', telephone='$telephone', adresse='$adresse', salaire='$salaire', idRespo='$idRespo' WHERE id=$id");
    }

    public function archiver(int $id): int {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    // public function findAll(): array {
    //     $stmt = $this->pdo->query("SELECT * FROM $this->table WHERE archived=0");
    //     return $stmt->fetchAll();
    // }


    public function findAll(): array
{

    return $this->executeSelect("SELECT r.*, tr.nomType FROM `responsable` r INNER JOIN typerespo tr ON r.idRespo = tr.id ;");
}
}
?>
