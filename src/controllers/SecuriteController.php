<?php
namespace App\Controllers;
use App\Core\Controller;
use App\Core\Session;
use App\Core\Validator;
use App\Core\Autorisation;
use App\Models\UserModel;
class SecuriteController extends Controller{

    private UserModel $userModel;
    public function __construct()
     {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->layout="connexion";
        $this->load();
    }
    public function load() {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "connexion") {
                unset($_POST['action']);
                unset($_POST['controller']);
                $this->connexion($_POST);   
            } elseif ($_REQUEST['action'] == "show-form") {
                $this->showForm();
            } elseif ($_REQUEST['action'] == "logout") {
                $this->logout();
            }
        }else{
            $this->showForm(); 
        }
    }
    private function logout():void{
        Session::fermer();
        $this->redirectToRoute("controller=securite&action=show-form");
    }
    private function showForm():void{
        parent::renderView("securite/form",[], $this->layout);
    }
    
    private function connexion(array $data):void{
        if (!Validator::isEmpty($data["login"], "login")) {
            Validator::isEmail($data["login"], "login");
        }
        Validator::isEmpty($data["password"], "password");
        if (Validator::isValid()) {
            $userConnect= $this->userModel->finByLoginAndPassword($data["login"],$data["password"]);
            if ($userConnect) {
                Session::add("userConnect",$userConnect);
                $this->redirectToRoute("controller=article&action=liste-article");
                return;
            } else {
                Validator::add("error_connection","Utilisateur introuvable");
                Session::add("errors", Validator::$errors);
            }
        } else {
            Session::add("errors",Validator::$errors); 
        }
        $this->redirectToRoute("controller=securite&action=show-form");
    }
    

}
