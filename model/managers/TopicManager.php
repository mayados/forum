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

            $sql = "SELECT titre, topic.dateCreation, id_topic, topic.user_id, verrouillage, COUNT(texte) AS countPost
                    FROM topic
                    LEFT JOIN post ON topic.id_topic = post.topic_id
                    WHERE id_".$this->tableName." AND categorie_id = :id
                    GROUP BY titre, id_topic
                    ORDER BY dateCreation DESC";

            /* Plusieurs objets sont attendus car il y a plusieurs topics */
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );

        }

        public function findLastTopics($id){
            
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

        public function findTopicsByUser($id){

            $sql = "SELECT titre,id_topic, user_id, verrouillage, dateCreation
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
            WHERE id_topic = :id";

            return $this->getSingleScalarResult(
                DAO::select($sql, ['id' => $id]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );

        }

        public function updateTopic($id,$titre){

            $sql = "UPDATE ".$this->tableName."
            SET titre = :titre
            WHERE id_topic = :id";

            return $this->getSingleScalarResult(
                DAO::select($sql, ['id' => $id, 'titre' => $titre]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );

        }

        /* Créer une sorte de fonction findAll() pour trouver tous les sujets et le nombre de posts (count(post)) */

        public function findAllTopicsAndPosts(){
            $sql = "SELECT titre,id_topic,topic.dateCreation,topic.user_id,topic.verrouillage,categorie_id, COUNT(texte) AS countPost
            FROM ".$this->tableName."
            LEFT JOIN post ON topic.id_topic = post.topic_id
            WHERE id_topic = id_".$this->tableName." 
            GROUP BY titre, id_topic
            ORDER BY topic.dateCreation DESC
            ";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
        
    }
