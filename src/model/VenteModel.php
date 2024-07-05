<?php

namespace App\Models;

use App\Core\Model;

class VenteModel extends Model
{
    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table = "vente";
    }

    public function save(array $data): int
    {
        try {
            $date = $data['date'] ?? '';
            $qte = $data['qte'] ?? '';
            $prix = $data['prix'] ?? '';
            $montant = $data['montant'] ?? '';
            $observation = $data['observation'] ?? '';
            $articleId = $data['articleId'] ?? '';
            $clientId = $data['clientId'] ?? '';

            $stmt = $this->pdo->prepare("INSERT INTO vente (date, qte, prix, montant, observation, articleId, clientId) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$date, $qte, $prix, $montant, $observation, $articleId, $clientId]);

            return $this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            error_log('Erreur lors de l\'ajout de la vente : ' . $e->getMessage());
            throw new \PDOException('Erreur lors de l\'ajout de la vente : ' . $e->getMessage());
        }
    }




    public function findAll(): array
    {
        return $this->executeSelect("SELECT v.*, a.libelle AS article_libelle, c.nomComplet AS client_nom FROM vente v 
                                     INNER JOIN article a ON v.articleId = a.id 
                                     INNER JOIN client c ON v.clientId = c.id");
    }


}
