<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Autorisation;
use App\Models\FournisseurModel;

class FournisseurController extends Controller
{
    private FournisseurModel $fournisseurModel;

    public function __construct()
    {
        parent::__construct();
        if (!Autorisation::isConnect()) {
            $this->redirectToRoute("controller=securite&action=show-form");
        }
        $this->fournisseurModel = new FournisseurModel();
        $this->load();
    }

    public function load()
    {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "add-fournisseur") {
                $this->ajouterFournisseur($_POST);
            } elseif ($_REQUEST['action'] == "liste-fournisseur") {
                $this->listerFournisseur();
            } elseif ($_REQUEST['action'] == "form-fournisseur") {
                $this->chargerFormulaire();
            } elseif ($_REQUEST['action'] == "archiver-fournisseur") {
                $this->archiverFournisseur();
            } elseif ($_REQUEST['action'] == "edit-fournisseur") {
                $this->modifierFournisseur();
            }
            elseif ($_REQUEST['action'] == "get-tel") {
                $telFour=$_REQUEST['tel'];
                $fournisseur = $this->fournisseurModel->findByTel($telFour);
                $this->renderJson([
                    "statut"=>$fournisseur!=false?200:204,
                    "data"=>$fournisseur!=false?$fournisseur:null
                ]);

            }
        }
    }

    public function archiverFournisseur(): void {
        $id = $_REQUEST['id'];
        if ($id && $this->fournisseurModel->archiver($id)) {
            $this->redirectToRoute("controller=fournisseur&action=liste-fournisseur");
        } else {
            // Gérer les erreurs ou rediriger avec un message d'erreur
            $this->redirectToRoute("controller=fournisseur&action=liste-fournisseur", ['error' => 'Archivage échoué']);
        }
    }
    
    public function modifierFournisseur(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'nomFour' => $_POST['nomFour'],
                'telFour' => $_POST['telFour'],
                'adresseFour' => $_POST['adresseFour'],
            ];
            $this->fournisseurModel->update($data);
            $this->redirectToRoute("controller=fournisseur&action=liste-fournisseur");
        }
    }
    
    public function chargerFormulaire(): void
    {
        $this->renderView("fournisseurs/form", [
            "fournisseurs" => $this->fournisseurModel->findAll(),
        ]);
    }

    public function ajouterFournisseur(array $data): void
    {
        try {
            $this->fournisseurModel->save($data);
            parent::redirectToRoute("controller=fournisseur&action=liste-fournisseur");
        } catch (\Exception $e) {
            error_log('Erreur lors de l\'ajout du fournisseur : ' . $e->getMessage());
        }
    }

    public function listerFournisseur(): void
    {
        $datas = $this->fournisseurModel->findAll();
        parent::renderView("fournisseurs/liste", [
            "fournisseurs" => $datas
        ]);
    }
}
?>
