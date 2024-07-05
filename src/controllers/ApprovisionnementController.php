<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Autorisation;
use App\Core\Session;
use App\Models\ApproModel;
use App\Models\ArticleModel;

use App\Models\FournisseurModel;
use App\Models\PanierModel;

class ApprovisionnementController extends Controller {
    private ArticleModel $articleModel;
    private ApproModel $approModel;
    private FournisseurModel $fournisseurModel;

    public function __construct() {
        parent::__construct();
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("controller=securite&action=show-form");  
        }
        $this->articleModel=new ArticleModel();
        $this->approModel=new approModel();
        $this->fournisseurModel=new FournisseurModel();
        $this->load();
    }
    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "liste-appro") {
                $this->listerAppro();
            } elseif ($_REQUEST['action'] == "form-appro") {
                $this->chargerFormulaire();
            }elseif ($_REQUEST['action'] == "add-article") {
                $this->ajouterArticleDansAppro($_POST);

            }elseif ($_REQUEST['action'] == "add-appro") {
                $this->ajouterAppro();
            }
        }else{
            $this->listerAppro();
        }
    }

    public function ajouterArticleDansAppro(array $data): void {
        if (Session::get("panier") == false) {
            $panier = new PanierModel();
        } else {
            $panier = Session::get("panier");
        }
    
        $article = $this->articleModel->findById($data["articleId"]);
        $panier->addArticle($article, $data["fournisseurId"], $data["qteAppro"]);
        Session::add("panier", $panier);
        $this->redirectToRoute("controller=appro&action=form-appro");
    }
    

    public function ajouterAppro(): void {
        $panier = Session::get("panier");
        
        if ($panier) {
            $approId = $this->approModel->save($panier); // Appel à la méthode save du modèle Approvisionnement
            
            if ($approId) {
                Session::remove("panier"); // Suppression du panier après l'ajout
                $this->redirectToRoute("controller=appro&action=form-appro"); // Redirection vers la page de formulaire d'approvisionnement
            } else {
                // Gérer les erreurs si l'ajout de l'approvisionnement a échoué
                // Peut-être afficher un message d'erreur ou rediriger vers une page d'erreur
            }
        } else {
            // Gérer le cas où le panier n'existe pas ou est vide
            // Peut-être afficher un message d'erreur ou rediriger vers une page d'erreur
        }
    }
    
    
    public function listerAppro(): void {
        $this->renderView("appros/liste", [
            "appros" => $this->approModel->findAll(),
          
        ]);
    }

    
    public function chargerFormulaire(): void {
        $panier = Session::get("panier") ?: new PanierModel();
        
        $this->renderView("appros/form1", [
            "fournisseurs" => $this->fournisseurModel->findAll(),
            "articles" => $this->articleModel->findAll(),
            "panier" => $panier
        ]);
    }
    
    
}
?>
