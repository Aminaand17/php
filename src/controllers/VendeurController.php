<?php
namespace App\Controllers;
use App\Core\Session;
use App\Core\Validator;
use App\Core\Controller;
use App\Models\TypeModel;
use App\Core\Autorisation;
use App\Models\ClientModel;
use App\Models\VendeurModel;

class VendeurController extends Controller{

    private VendeurModel $vendeurModel;
    public function __construct() {
        parent::__construct();
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("controller=securite&action=show-form");  
        }
        $this->vendeurModel = new VendeurModel();
        $this->load();
    }

    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "add-vendeur") {
                $this->ajouterVendeur($_POST);

            } elseif ($_REQUEST['action'] == "liste-vendeur") {
                $this->listerVendeur();
            }
            elseif ($_REQUEST['action'] == "form-vendeur") {
                $this->chargerFormulaire();
            } elseif ($_REQUEST['action'] == "archiver-vendeur") {
                $this->archiverVendeur();
            } elseif ($_REQUEST['action'] == "edit-vendeur") {
                $this->modifierVendeur();
            }
        }
    }
    public function archiverVendeur(): void {
        $id = $_REQUEST['id'];
        if ($id && $this->vendeurModel->archiver($id)) {
            $this->redirectToRoute("controller=vendeur&action=liste-vendeur");
        } else {
            // Gérer les erreurs ou rediriger avec un message d'erreur
            $this->redirectToRoute("controller=vendeur&action=liste-vendeur", ['error' => 'Archivage échoué']);
        }
    }
    
    
    
    public function modifierVendeur(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'nomComplet' => $_POST['nomComplet'],
                'telephone' => $_POST['telephone'],
                'adresse' => $_POST['adresse'],
                'salaire' => $_POST['salaire'],
            ];
            $this->vendeurModel->update($data);
            $this->redirectToRoute("controller=vendeur&action=liste-vendeur");
        }
    }
    
    public function chargerFormulaire():void {
        $this->renderView("vendeurs/form",[
           "vendeurs"=> $this->vendeurModel->findAll(),


           
        ]);
    }
    public function ajouterVendeur(array $data): void {
        try {
            $this->vendeurModel->save($data);
            parent::redirectToRoute("controller=vendeur&action=liste-vendeur");
        } catch (\Exception $e) {
            error_log('Erreur lors de l\'ajout du vendeur : ' . $e->getMessage());
            // Afficher un message d'erreur à l'utilisateur ou rediriger vers une page d'erreur
        }
    }
    
        
    
    

    // public function listertype():void{
    //     // Assurer qu'aucune sortie n'est envoyée avant l'appel à header()
    //     ob_start();
    //     $types = $this->typeModel->findAll();
    //     require_once "../views/types/liste.html.php";
    //     $contentView=  ob_get_clean();
    //     require_once "../views/layout/base.layout.php";
    // }

    public function listerVendeur():void
    {
        $datas = $this->vendeurModel->findAll();
        parent::renderView("vendeurs/liste",[
            "vendeurs"=>$datas
        ]);
    
    }
}

?>
