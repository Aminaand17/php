<?php
namespace App\Controllers;
use App\Core\Session;
use App\Core\Validator;
use App\Core\Controller;
use App\Models\TypeModel;
use App\Core\Autorisation;
use App\Models\ClientModel;
use App\Models\ResponsableModel;
use App\Models\TypeRespoModel;
use App\Models\VendeurModel;

class ResponsableController extends Controller{

    private ResponsableModel $responsableModel;
    private TypeRespoModel $typeRespoModel;
    public function __construct() {
        parent::__construct();
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("controller=securite&action=show-form");  
        }
        $this->typeRespoModel = new TypeRespoModel();
        $this->responsableModel = new ResponsableModel();
        $this->load();
    }

    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "add-respo") {
                $this->ajouterRespo($_POST);

            } elseif ($_REQUEST['action'] == "liste-respo") {
                $this->listerRespo();
            }
            elseif ($_REQUEST['action'] == "form-respo") {
                $this->chargerFormulaire();
            } elseif ($_REQUEST['action'] == "archiver-respo") {
                $this->archiverRespo();
            } elseif ($_REQUEST['action'] == "edit-respo") {
                $this->modifierRespo();
            }
        }
    }
    public function archiverRespo(): void {
        $id = $_REQUEST['id'];
        if ($id && $this->responsableModel->archiver($id)) {
            $this->redirectToRoute("controller=respo&action=liste-respo");
        } else {
            // Gérer les erreurs ou rediriger avec un message d'erreur
            $this->redirectToRoute("controller=respo&action=liste-respo", ['error' => 'Archivage échoué']);
        }
    }
    
    
    public function modifierRespo(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'nomComplet' => $_POST['nomComplet'],
                'telephone' => $_POST['telephone'],
                'adresse' => $_POST['adresse'],
                'salaire' => $_POST['salaire'],
                'idRespo' => $_POST['idRespo'],
            ];
            $this->responsableModel->update($data);
            $this->redirectToRoute("controller=respo&action=liste-respo");
        }
        }
    public function chargerFormulaire():void {
        $this->renderView("responsables/form",[
           "respos"=> $this->responsableModel->findAll(),
           "typesrespo" => $this->typeRespoModel->findAll(),


           
        ]);
    }
    public function ajouterRespo(array $data): void {
        try {
            $this->responsableModel->save($data);
            parent::redirectToRoute("controller=respo&action=liste-respo");
        } catch (\Exception $e) {
            error_log('Erreur lors de l\'ajout du responsable : ' . $e->getMessage());
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

    public function listerRespo():void
    {
        $datas = $this->responsableModel->findAll();
        parent::renderView("responsables/liste",[
            "respos"=>$datas
        ]);
    
    }
}

?>
