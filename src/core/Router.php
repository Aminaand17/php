<?php
namespace App\Core;

use App\Controllers\TypeController;
use App\Controllers\ClientController;
use App\Controllers\ArticleController;
use App\Controllers\VendeurController;
use App\Controllers\SecuriteController;
use App\Controllers\CategorieController;
use App\Controllers\ProductionController;
use App\Controllers\ApprovisionnementController;
use App\Controllers\FournisseurController;
use App\Controllers\ResponsableController;
use App\Controllers\VenteController;

class Router {
    public  static function run(){
        if (isset($_REQUEST['controller'])) {
            if ($_REQUEST['controller'] == "article") {
                require_once("../src/controllers/ArticleController.php");
                $controller=new ArticleController();
            } elseif ($_REQUEST['controller'] == "type") {
                require_once("../src/controllers/TypeController.php");
                $controller=new TypeController();
            }elseif ($_REQUEST['controller'] == "categorie") {
                require_once("../src/controllers/CategorieController.php");
                $controller=new CategorieController();
            }elseif ($_REQUEST['controller'] =="securite") {
                require_once("../src/controllers/SecuriteController.php");
                $controller=new SecuriteController();
            }elseif ($_REQUEST['controller'] =="appro") {
                $controller=new ApprovisionnementController();
            } elseif ($_REQUEST['controller'] =="production") {
                $controller=new ProductionController();
            } elseif ($_REQUEST['controller'] =="client") {
                $controller=new ClientController();
            } elseif ($_REQUEST['controller'] =="vendeur") {
                $controller=new VendeurController();
            } elseif ($_REQUEST['controller'] =="fournisseur") {
                $controller=new FournisseurController();
            } elseif ($_REQUEST['controller'] =="respo") {
                $controller=new ResponsableController();
            }elseif ($_REQUEST['controller'] =="vente") {
                $controller=new VenteController();
            }
            
        }else{
            require_once("../src/controllers/SecuriteController.php");
            $controller=new SecuriteController(); 

        }
    }
}


?>

