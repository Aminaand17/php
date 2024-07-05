<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Session;

class ApproModel extends Model
{
    public function __construct()
    {
        $this->ouvrirConnexion();
        $this->table = "appro";
    }


    public function save(PanierModel $panier): int {
        $date = (new \DateTime())->format('Y-m-d');
        $userId = Session::get('userConnect')['id'];
        
        $this->executeUpdate("INSERT INTO `appro` (`date`, `montant`, `fournisseurId`, `userId`) VALUES ('$date', {$panier->total}, {$panier->fournisseur}, $userId)");
    
        $approId = $this->pdo->lastInsertId();
    
        foreach ($panier->articles as $article) {
            $qteAppro = $article["qteAppro"];
            $qteStock = $article["qteStock"];
            $montantArticle = $article["montantArticle"];
            $idArticle = $article["id"];
            
            $this->executeUpdate("INSERT INTO `detail` (`qteAppro`, `approId`, `articleId`, `montant`) VALUES ($qteAppro, $approId, $idArticle, $montantArticle)");
            $this->executeUpdate("UPDATE `article` SET qteStock = qteStock + $qteAppro WHERE `id` = $idArticle");
        }
    
        return 1;
    }
    


    public function findAll(): array
    {
        return $this->executeSelect("SELECT * FROM  fournisseur f ,$this->table a  where a.`fournisseurId`=f.id ;");
    }
}
