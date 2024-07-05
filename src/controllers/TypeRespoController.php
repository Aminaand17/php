<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Session;
use App\Core\Validator;
use App\Core\Autorisation;
use App\Models\TypeRespoModel;
class TypeRespoController extends Controller{

    private TypeRespoModel $typeRModel;
    public function __construct() {
        parent::__construct();
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("controller=securite&action=show-form");  
        }
        $this->typeRModel = new TypeRespoModel();
        $this->load();
    }

    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "add-typerespo") {
                unset($_POST['action']);
                unset($_POST['controller']);
                $this->ajouterType($_POST);   
            } elseif ($_REQUEST['action'] == "liste-typerespo") {
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
            $typerespo=$this->typeRModel->findByNameType($data["nomType"]);
            if ($typerespo ) {
                Validator::add("nomType","la valeur existe deja");
                Session::add("errors", Validator::$errors);
            } else {
                $this->typeRModel->save($data);
            }
            
        } else {
            Session::add("errors", Validator::$errors);
        }

        parent::redirectToRoute("controller=type&action=liste-typerespo");
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
        $datas = $this->typeRModel->findAll();
        parent::renderView("typesresto/liste",[
            "typesrespo"=>$datas
        ]);
    
    }
}
?>
