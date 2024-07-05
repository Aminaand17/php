<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Autorisation;
use App\Models\ArticleModel;
use App\Models\CategorieModel;
use App\Models\TypeModel;
class ArticleController extends Controller {
    private ArticleModel $articleModel;
    private CategorieModel $categorieModel;
    private TypeModel $typeModel;

    public function __construct() {
        parent::__construct();
        if(!Autorisation::isConnect()){
            $this->redirectToRoute("controller=securite&action=show-form");  
        }
        $this->articleModel=new ArticleModel();
        $this->categorieModel=new CategorieModel();
        $this->typeModel=new TypeModel();
        $this->load();
    }
    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "add-article") {
                unset($_POST['action']);
                unset($_POST['controller']);
                $this->ajouterArticle($_POST);
            } elseif ($_REQUEST['action'] == "liste-article") {

                $this->listerArticle($_REQUEST['page']);
            } elseif ($_REQUEST['action'] == "form-article") {
                $this->chargerFormulaire();
            }
        } else{
            $this->listerArticle();
        }
    }

    //public function ajouterArticle(array $data) {
        //parent::redirectToRoute("controller=type&action=liste-article");
        //$this->articleModel->save($data);
       
    //}
    public function ajouterArticle(array $data):void {
        $this->articleModel->save($data);
        $this->redirectToRoute("controller=article&action=liste-article&page=0");
       // parent::redirectToRoute("controller=article&action=liste-article");
    }
    
    public function listerArticle(int $page=0): void {
        $this->renderView("articles/liste", [
            "response" => $this->articleModel->findAllWithPaginate($page *OFFSET),
            "currentPage"=>$page
        ]);
    }

    
    
    public function chargerFormulaire():void {
        $this->renderView("articles/form",[
            "categories"=>$this->categorieModel->findAll(),
            "types"=>$this->typeModel->findAll(),
        ]);
    }
    
}
?>
