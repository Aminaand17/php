<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Autorisation;
use App\Models\VenteModel;
use App\Models\ArticleModel;
use App\Models\ClientModel;

class VenteController extends Controller {
    private VenteModel $venteModel;
    private ArticleModel $articleModel;
    private ClientModel $clientModel;

    public function __construct() {
        parent::__construct();
        if (!Autorisation::isConnect()) {
            $this->redirectToRoute("controller=securite&action=show-form");
        }
        $this->venteModel = new VenteModel();
        $this->articleModel = new ArticleModel();
        $this->clientModel = new ClientModel();
        $this->load();
    }

    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "add-vente") {
                $this->ajouterVente($_POST);
            } elseif ($_REQUEST['action'] == "liste-vente") {
                $this->listerVente();
            } elseif ($_REQUEST['action'] == "form-vente") {
                $this->chargerFormulaire();
            }
        }
    }

    public function chargerFormulaire(): void {
        $this->renderView("ventes/form", [
            "articles" => $this->articleModel->findAll(),
            "clients" => $this->clientModel->findAll(),
        ]);
    }

    public function ajouterVente(array $data): void {
        try {
            $this->venteModel->save($data);
            $this->redirectToRoute("controller=vente&action=liste-vente");
        } catch (\PDOException $e) {
            error_log('Erreur lors de l\'ajout de la vente : ' . $e->getMessage());
            // Gérer l'erreur d'une manière appropriée selon votre application
        }
    }

    

    public function listerVente(): void {
        $ventes = $this->venteModel->findAll();
        $this->renderView("ventes/liste", [
            "ventes" => $ventes,
        ]);
    }


    
}
