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

        public function listTopics(){
            $sql = "SELECT titre
            FROM ".$this->tableName."";

            /* Plusieurs objets sont attendus car il y a plusieurs topics */
            return $this->getMultipleResults(
                DAO::select($sql),
                $this->className
            );  
        }

        /* Méthode pour trouver tous les sujets d'une catégorie */
        public function findTopicsByCategorie($id){

            $sql = "SELECT titre, dateCreation, id_sujet
            FROM ".$this->tableName."
            WHERE categorie_id = :id
            ORDER BY dateCreation DESC";

            /* Plusieurs objets sont attendus car il y a plusieurs topics */
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );

        }

        public function insertTopic($id){
            /* Il faut d'abord vérifier que ça a été soumis via le formulaire avec les données que l'on souhaite */
            if(isset($_POST['submit'])){

                $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);
                // $message = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);

                /* S'il y a la donnée titre */
                if($titre){

                    /* Voir si les simple quotes ne posent pas des soucis au moment de l'ajout dans la bdd */
                    $sql = "INSERT INTO
                    topic(titre,verrouillage,categorie_id,membre_id)
                    VALUES(:titre,'0',:id,'3')";

                    /* Plusieurs objets sont attendus car il y a plusieurs topics */
                    return $this->getMultipleResults(
                        DAO::select($sql,['titre' => $titre,'id'=>$id]),
                        $this->className
                    );   

                }


            }
        }



    }