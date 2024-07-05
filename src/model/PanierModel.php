<?php
namespace App\Models;


class PanierModel{
    public $fournisseur=null;
    public array $articles=[];
    public $total=0;

    public function addArticle($article, $fournisseur, $qteAppro) {
        $montantArticle = $this->montantArticle($article["prixAppro"], $qteAppro);
        $article["qteAppro"]=$qteAppro;
        $article["montantArticle"]=$montantArticle;
        $this->fournisseur= $fournisseur;
        $this->articles[]=$article;
        $this->total+=$montantArticle;
        // $key=$this->articleExist($article);
        // if ($key!=-1) {
        //     $this->articles[$key]["qteAppro"]+=$qteAppro;
        //     $this->articles[$key]["montantArticle"]+=$montantArticle;
        // }else{
        //     $article["qteAppro"] = $qteAppro;
        //     $article["montantArticle"] = $montantArticle;
        //     $this->articles[] = $article;

        // }
        // $this->fournisseur = $fournisseur;
        // $this->total += $montantArticle;
    }
    
    public function montantArticle($prix,$qteAppro){
        return $prix * $qteAppro;
    }
    public function articleExist($article):bool{
        return false;
    }
    public function clear():void{
       $this->articles=[];
       $this->total=0;
       $this->fournisseur=null;

    }
}