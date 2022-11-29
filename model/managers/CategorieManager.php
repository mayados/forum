<?php

    /* Les requêtes sql se font dans les managers */

    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    /* PostManager hérite de la class Manager pour bénéficier des méthodes pré-établies : findAll, findOneById.. */
    class CategorieManager extends Manager{

        /* Nom de la class dans le dossier enities */
        protected $className = "Model\Entities\Categorie";
        /* Nom de la table en base de données */
        protected $tableName = "categorie";


        public function __construct(){
            parent::connect();
        }

        /* Méthode pour trouver tous les posts d'un topic */
        public function findPostsByTopic($id){

            $sql = "SELECT *
            FROM ".$this->tableName."p
            WHERE p.topic_id = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );

        }

    }