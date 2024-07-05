<?php

namespace App\Controllers;

use App\Core\Session;
use App\Core\Validator;
use App\Core\Controller;
use App\Core\Autorisation;
use App\Models\ArticleModel;
use App\Models\ProductionModel;

class ProductionController extends Controller
{

    private ProductionModel $productionModel;
    private ArticleModel $articleModel;

    public function __construct()
    {
        parent::__construct();

        if (!Autorisation::isConnect()) {
            $this->redirectToRoute("controller=securite&action=show-form");
        }

        $this->productionModel = new ProductionModel();
        $this->articleModel = new ArticleModel();
        $this->load();
    }

    public function load()
    {
        if (isset($_REQUEST['action'])) {
            if ($_REQUEST['action'] == "liste-production") {
                $this->listeProduction();
            } elseif ($_REQUEST['action'] == "form-production") {
                $this->chargerFormulaire();
            } elseif ($_REQUEST['action'] == "add-production") {
                $this->ajouterProduction($_POST);
            } elseif ($_REQUEST['action'] == "edit-production") {
                $this->modifierProduction($_POST);
            } elseif ($_REQUEST['action'] == "archiver-production") {
                $this->archiverProduction();
            } elseif ($_REQUEST['action'] == "productions-par-date") {
                $this->productionsParDate($_GET['date']);
            } elseif ($_REQUEST['action'] == "productions-par-article") {
                $this->productionsParArticle($_GET['articleId']);
            }
        } else {
            $this->listeProduction();
        }
    }

    public function modifierProduction(array $data): void
    {
        try {
            $this->productionModel->update($data);
            parent::redirectToRoute("controller=production&action=liste-production");
        } catch (\Exception $e) {
            error_log('Erreur lors de la modification de la production : ' . $e->getMessage());
        }
    }

    public function archiverProduction(): void
    {
        try {
            $id = $_GET['id'];
            $this->productionModel->archiver($id);
            parent::redirectToRoute("controller=production&action=liste-production");
        } catch (\Exception $e) {
            error_log('Erreur lors de l\'archivage de la production : ' . $e->getMessage());
        }
    }


    public function chargerFormulaire(): void
    {
        $this->renderView("productions/form", [
            "articles" => $this->articleModel->findAll()
        ]);
    }

    public function ajouterProduction(array $data): void
    {
        try {
            $this->productionModel->save($data);
            parent::redirectToRoute("controller=production&action=liste-production");
        } catch (\Exception $e) {
            error_log('Erreur lors de l\'ajout du vendeur : ' . $e->getMessage());
        }
    }

    public function listeProduction(): void
    {
        $this->renderView("productions/liste", [
            "productions" => $this->productionModel->findAll()
        ]);
    }

    public function productionsParArticle(int $articleId): void
    {
        $productions = $this->productionModel->findByArticle($articleId);
        $this->renderView("productions/par-article", [
            "productions" => $productions
        ]);
    }


    public function productionsParDate(string $date): void
    {
        $productions = $this->productionModel->findByDate($date);
        $this->renderView("productions/par-date", [
            "productions" => $productions
        ]);
    }
}
