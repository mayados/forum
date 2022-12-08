<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    /* Topic Manager hérite de la class Manager pour bénéficier des méthodes pré-établies : findAll, findOneById.. */
    class TopicManager extends Manager{

        /* Nom de la class dans le dossier enities */
        protected $className = "Model\Entities\Topic";
        /* Nom de la table en base de données */
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        // public function listTopics(){
        //     $sql = "SELECT titre
        //     FROM ".$this->tableName."";

        //     /* Plusieurs objets sont attendus car il y a plusieurs topics */
        //     return $this->getMultipleResults(
        //         DAO::select($sql),
        //         $this->className
        //     );  
        // }

        /* Méthode pour trouver tous les sujets d'une catégorie */
        public function findTopicsByCategorie($id){

            $sql = "SELECT titre, dateCreation, id_sujet, user_id
            FROM ".$this->tableName."
            WHERE categorie_id = :id
            ORDER BY dateCreation DESC";

            /* Plusieurs objets sont attendus car il y a plusieurs topics */
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );

        }

        public function findTopicsByUser($id){

            $sql = "SELECT titre, user_id
            FROM ".$this->tableName."
            WHERE user_id = :id
            ORDER BY dateCreation DESC";

            /* Plusieurs objets sont attendus car il y a plusieurs topics */
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );
        }

        /* Clore un sujet */
        public function closeTopic($id){

            $sql = "UPDATE ".$this->tableName."
            SET verrouillage = 1
            WHERE id_sujet = :id";

            return $this->getSingleScalarResult(
                DAO::select($sql, ['id' => $id]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );

        }
        
    }