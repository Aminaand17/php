<?php

namespace App\Core;
class Model {
    protected $dsn = 'mysql:host=localhost:3306;dbname=bdphp';
    protected $username = 'root';
    protected $password = 'nouveau_mot_de_passe';
    protected \PDO|NULL $pdo=null;
    protected string $table; 
        
         
        public function ouvrirConnexion():void
        {
            try {
                if($this->pdo==null){
                    $this->pdo = new \PDO($this->dsn, $this->username, $this->password);
                }  
            } 
            catch (\PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
            }
        }   
        public function fermerConnexion():void
                {
                if($this->pdo!=null){
                    $this->pdo=null;
                }

                        
        }   
        protected function executeSelect(string $sql,bool $fetch=false):array|false {
            try {
                $stm = $this->pdo->query($sql);
                return $fetch? $stm->fetch(\PDO::FETCH_ASSOC): $stm->fetchAll(\PDO::FETCH_ASSOC);
            } catch (\PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
                return []; 
            }
        }
        public function findAll(): array
        {
           
            return $this->executeSelect("SELECT * FROM  $this->table");
        }
        public function findById(int $id): array
            {
                return $this->executeSelect("SELECT a.*FROM  $this->table where id=$id",true);
            } 
        
            protected function executeUpdate(string $sql): int
            {
                try {
                    return $this->pdo->exec($sql);
                } catch (\PDOException $e) {
                    echo "Erreur de connexion : " . $e->getMessage();
                    return 0; // Retourne 0 ou gérer l'erreur selon votre application
                }
            }
            
            
}