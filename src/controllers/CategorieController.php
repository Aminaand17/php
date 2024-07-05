<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Session;
use App\Core\Validator;
use App\Core\Autorisation;
use App\Models\CategorieModel;
class CategorieController extends Controller{
    /** @var CategorieModel */
    private $categorieModel;
    public function __construct(){
        $this->categorieModel=new CategorieModel();
        $this->load();
    }
    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "add-categorie") {
                unset($_POST['action']);
                unset($_POST['controller']);
                $this->ajouterCategorie($_POST); // Utilisation de $this-> pour appeler la méthode de la même classe
            } elseif ($_REQUEST['action'] == "liste-categorie") {
                $this->listercategorie(); // Utilisation de $this-> pour appeler la méthode de la même classe
            }
        }
    }
    //public function ajouterCategorie(array $data) {
       // $this->categorieModel->save($data);
        // Assurer qu'aucune sortie n'est envoyée avant l'appel à header()
      //  ob_start();
      //  header('Location:'.WEBROOT.'/?controller=categorie&action=liste-categorie');
       // ob_end_flush();
       // exit(); // Terminer le script après la redirection
    //}
       
    
    public function ajouterCategorie(array $data): void {
        $validator = new Validator();
    
        // Vérifier si la clé "nomCategorie" existe dans le tableau $data
        if (isset($data["nomCategorie"])) {
            // Validation du champ nomCategorie
            $validator->isEmpty($data["nomCategorie"], "nomCategorie");
        } else {
            // Traiter le cas où la clé nomCategorie n'est pas définie
            // Vous pouvez générer une erreur, afficher un message, ou prendre une autre action appropriée
        }
    
        // Vérification si des erreurs existent
        if ($validator->isValid()) {
            // Aucune erreur, enregistrer les données
            $categorieData = [
                'nomCategorie' => $data["nomCategorie"]
            ];
            $this->categorieModel->save($categorieData);
        } else {
            // Des erreurs sont présentes, ajouter les erreurs à la session
            Session::add("errors", $validator->errors);
        }
    
        // Redirection vers la liste des catégories
        parent::redirectToRoute("controller=categorie&action=liste-categorie");
    }
    

    public function listercategorie():void{
        // Assurer qu'aucune sortie n'est envoyée avant l'appel à header()
        ob_start();
        $categories = $this->categorieModel->findAll();
        require_once "../views/categorie/liste.html.php";
        $contentView=  ob_get_clean();
        require_once "../views/layout/base.layout.php";
    }
}
?>

