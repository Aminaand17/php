<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Session;
use App\Core\Validator;
use App\Core\Autorisation;
use App\Models\TypeModel;
class TypeController extends Controller{

    private TypeModel $typeModel;
    public function __construct() {
        parent::__construct();
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("controller=securite&action=show-form");  
        }
        $this->typeModel = new TypeModel();
        $this->load();
    }

    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "add-type") {
                unset($_POST['action']);
                unset($_POST['controller']);
                $this->ajouterType($_POST);   
            } elseif ($_REQUEST['action'] == "liste-type") {
                $this->listertype();
            }
        }
    }

    public function ajouterType(array $data):void {
        $validator = new Validator();
    
        // Validation du champ nomType
        Validator::isEmpty($data["nomType"], "nomType");
        if (Validator::isValid()) {
            // Aucune erreur, enregistrer les données
            $type=$this->typeModel->findByNameType($data["nomType"]);
            if ($type ) {
                Validator::add("nomType","la valeur existe deja");
                Session::add("errors", Validator::$errors);
            } else {
                $this->typeModel->save($data);
            }
            
        } else {
            // Des erreurs sont présentes, ajouter les erreurs à la session
            Session::add("errors", Validator::$errors);
        }
    
        // Redirection vers la liste des types
        parent::redirectToRoute("controller=type&action=liste-type");
    }
    

    // public function listertype():void{
    //     // Assurer qu'aucune sortie n'est envoyée avant l'appel à header()
    //     ob_start();
    //     $types = $this->typeModel->findAll();
    //     require_once "../views/types/liste.html.php";
    //     $contentView=  ob_get_clean();
    //     require_once "../views/layout/base.layout.php";
    // }

    public function listertype():void
    {
        $datas = $this->typeModel->findAll();
        parent::renderView("types/liste",[
            "types"=>$datas
        ]);
    
    }
}
?>
