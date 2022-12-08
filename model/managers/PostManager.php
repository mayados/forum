<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    /* PostManager hérite de la class Manager pour bénéficier des méthodes pré-établies : findAll, findOneById.. */
    class PostManager extends Manager{

        /* Nom de la class dans le dossier enities */
        protected $className = "Model\Entities\Post";
        /* Nom de la table en base de données */
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        /* Méthode pour trouver tous les posts d'un topic */
        public function findPostsByTopic($id){

            $sql = "SELECT texte, dateCreation, user_id, topic_id
            FROM ".$this->tableName."
            WHERE topic_id = :id
            ORDER BY dateCreation ASC";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );

        }

    }