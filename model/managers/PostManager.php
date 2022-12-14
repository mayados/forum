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

            $sql = "SELECT texte, dateCreation, user_id, topic_id, id_post
            FROM ".$this->tableName."
            WHERE topic_id = :id
            ORDER BY dateCreation ASC";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );

        }


        public function findLastPosts($id){

            $sql = "SELECT *
            FROM ".$this->tableName."
            WHERE user_id = :id
            ORDER BY dateCreation DESC
            LIMIT 5";

            /* Plusieurs objets sont attendus car il y a plusieurs topics */
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );

        }

        public function deletePostsByTopic($id){

            $sql = "DELETE FROM ".$this->tableName."
            WHERE topic_id = :id";

            return $this->getSingleScalarResult(
                DAO::select($sql, ['id' => $id]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );

        }

        public function firstPostByTopic($id){

            $sql = "SELECT *
                    FROM ".$this->tableName." 
                    WHERE topic_id = :id
                    ORDER BY dateCreation ASC
                    LIMIT 1
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );

        }

        public function updateFirstPostTopic($texte){

            $sql = "UPDATE ".$this->tableName."
            SET texte = :texte
            WHERE topic_id = 94";

            return $this->getSingleScalarResult(
                DAO::select($sql, ['texte' => $texte]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );

        }

    }