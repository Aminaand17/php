<?php

namespace App\Models;

use App\Core\Model;

class VendeurModel extends Model
{
    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table = "vendeur";
    }

    // public function save(array $data): int {
    //     $nomComplet = $data['nomComplet'];
    //     $telephone = $data['telephone'];
    //     $adresse = $data['adresse'];
    //     $salaire = $data['salaire'];
    //     $photo = ''; // Photo par défaut, vous pouvez ajuster cela selon vos besoins

    //     $sql = "INSERT INTO `vendeur` (`nomComplet`, `telephone`, `adresse`, `salaire`, `photo`) VALUES ('$nomComplet', '$telephone', '$adresse', '$salaire', '$photo')";

    //     return $this->executeUpdate($sql);
    // }
    public function save(array $data): int
    {
        try {
            $nomComplet = $data['nomComplet'] ?? '';
            $telephone = $data['telephone'] ?? '';
            $adresse = $data['adresse'] ?? '';
            $salaire = $data['salaire'] ?? '';

            $stmt = $this->pdo->prepare("INSERT INTO vendeur (nomComplet, telephone, adresse, salaire) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nomComplet, $telephone, $adresse, $salaire]);
            error_log("Nom Complet: $nomComplet, Téléphone: $telephone, Adresse: $adresse, Salaire: $salaire");
            return $this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            error_log('Erreur de connexion : ' . $e->getMessage());
            throw new \PDOException('Erreur de connexion : ' . $e->getMessage());
        }
    }

    //     public function save(array $type): int
    // {
    //         extract($type);
    //         return $this->executeUpdate( "INSERT INTO `vendeur` (`nomComplet`,`telephone`,`adresse`,`salaire`) VALUES ('$nomType',$telephone,$adresse,$salaire);");      
    // }

    public function update(array $data): int
    {
        extract($data);
        return $this->executeUpdate("UPDATE $this->table SET nomComplet='$nomComplet', telephone='$telephone', adresse='$adresse', salaire='$salaire' WHERE id=$id");
    }

    public function archiver(int $id): int
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
