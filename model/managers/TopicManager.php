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
                $this->className
            );

        }

        public function insertTopic($id){
            /* Il faut d'abord vérifier que ça a été soumis via le formulaire avec les données que l'on souhaite */
            if(isset($_POST['submit'])){

                $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);

                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_SPECIAL_CHARS);


                /* S'il y a la donnée titre */
                if($titre){

                    $postManager = new PostManager();

                    /* Voir si les simple quotes ne posent pas des soucis au moment de l'ajout dans la bdd */
                    $sql = "INSERT INTO
                    topic(titre,verrouillage,categorie_id,user_id)
                    VALUES(:titre,'0',:id,'3')";

                    DAO::select($sql,['titre' => $titre,'id'=>$id]);
                    $this->className;

                    /* Trouver un moyen de mettre le dernier id inséré avec */

                    $insertMessage = "INSERT INTO
                    post(texte,sujet_id,user_id)
                    VALUES(:texte,:id,'3')"; 

                    DAO::select($insertMessage,['texte' => $texte,'id'=>$id]);
                    $this->className;

                    /* Ici, il n'y a pas de return, car on ne veut rien retourner, on veut juste rediriger, étant donné que l'on insert juste en base de données */
                    header('Location: index.php?ctrl=forum&action=detailCategorie&id='.$id.'');
                }


            }

        }



    }