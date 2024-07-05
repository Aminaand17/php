<?php
namespace App\Controllers;
use App\Core\Session;
use App\Core\Validator;
use App\Core\Controller;
use App\Models\TypeModel;
use App\Core\Autorisation;
use App\Models\ClientModel;

class ClientController extends Controller{

    private ClientModel $clientModel;
    public function __construct() {
        parent::__construct();
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("controller=securite&action=show-form");  
        }
        $this->clientModel = new ClientModel();
        $this->load();
    }

    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "add-client") {
                $this->ajouterClient($_POST);

            } elseif ($_REQUEST['action'] == "liste-client") {
                $this->listerClient();
            }
            elseif ($_REQUEST['action'] == "form-client") {
                $this->chargerFormulaire();
            }elseif ($_REQUEST['action'] == "archiver-client") {
                $this->archiverClient();
            } elseif ($_REQUEST['action'] == "edit-client") {
                $this->modifierClient();
            }
        }
    }



    public function archiverClient(): void {
        $id = $_REQUEST['id'];
        $this->clientModel->archiver($id);
        $this->redirectToRoute("controller=client&action=liste-client");
    }
    
    public function modifierClient(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id' => $_POST['id'],
                'nomComplet' => $_POST['nomComplet'],
                'telephone' => $_POST['telephone'],
                'adresse' => $_POST['adresse'],
                'salaire' => $_POST['salaire'],
            ];
            $this->clientModel->update($data);
            $this->redirectToRoute("controller=client&action=liste-client");
        }
    }
    

    public function chargerFormulaire():void {
        $this->renderView("clients/form",[
           "clients"=> $this->clientModel->findAll(),


           
        ]);
    }
    public function ajouterClient(array $data): void {
        try {
            $this->clientModel->save($data);
            parent::redirectToRoute("controller=client&action=liste-client");
        } catch (\Exception $e) {
            error_log('Erreur lors de l\'ajout du client : ' . $e->getMessage());
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

    public function listerClient():void
    {
        $datas = $this->clientModel->findAll();
        parent::renderView("clients/liste",[
            "clients"=>$datas
        ]);
    
    }
}
?>
