<?php
    /* Les controllers se contentent de réceptionner la requête demandée par le client, interrogent le manager adéquat, et envoient les infos à la vue = cherchent les infos et redirigent*/

    /* cette class sera contenue dans le namespace Controller */
    namespace Controller;

    /* Nous utilisons ces class, situées dans des namespace spécifiques */
    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
use Model\Managers\CategorieManager;
use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;

    
    /* ForumController a pour class mère AbstractController */
    /* On utlise la méthode index() vide créée dans ControllerInterface */
    class ForumController extends AbstractController implements ControllerInterface{

        /* La méthode index n'est pas obligatoire , mais il faut la mettre car on implémente ControllerInterface */
        public function index(){}

        

        /* On crée une fonction qui permet de lister toutes les catégories */
        public function listCategories(){
            /* On crée une instance de class de l'objet qui a les requêtes voulues */
            $categorieManager = new CategorieManager();
            /* On redirige vers la vue correspondante, ici c'est listCategories.php */
            /* Le nom des datas envoyées est "categories", qui fait appelle à la méthode findAll de l'instance $categorieManager, avec la colonne souhaitée. findAll est présente dans la class Manager du dossier App. MAIS comme CategorieManager a pour class mère Manager, on a accès à cette fonction */
            return [
                "view" => VIEW_DIR . "forum/listCategories.php",
                "data" => [
                    "categories" => $categorieManager->findAll(["nomCategorie","ASC"])
                ]
            ];

        }

        /* On crée une fonction qui permet de lister tous les topics = sujets */
        public function listTopics(){
            $topicManager = new TopicManager();
            /* On redirige vers la vue correspondante, ici c'est listCategories.php */
            /* Le nom des datas envoyées est "categories", qui fait appelle à la méthode findAll de l'instance $categorieManager, avec la colonne souhaitée. findAll est présente dans la class Manager du dossier App. MAIS comme CategorieManager a pour class mère Manager, on a accès à cette fonction */
           
            return [
                "view" => VIEW_DIR . "forum/listTopics.php",
                "data" => [
                    /* Le premier élément sert à dire sur quoi on se base pour trier, et le deuxième représente l'ordre de tri */
                    "topics" => $topicManager->findAll(["dateCreation","DESC"])
                ]
            ];  
        }


        /* Fonction pour afficher les topics présents dans une catégorie */
        public function detailCategorie(){
        /* On doit récupérer l'id envoyé dans le lien */
        $id = (isset($_GET["id"])) ? $_GET["id"] : null;

        $topicManager = new TopicManager();

        return [
            "view" => VIEW_DIR . "forum/detailCategorie.php",
            "data" => [
                "topics" => $topicManager->findTopicsByCategorie($id)
            ]
        ];

        }


        public function detailTopic(){

            $id = (isset($_GET["id"])) ? $_GET["id"] : null;

            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR . "forum/detailTopic.php",
                "data" => [
                "posts" => $postManager->findPostsByTopic($id)
                ]
            ];

        }

        /* Fonction pour créer un nouveau topic et un premier message sur ce dernier */

        public function nouveauTopic(){

            $id = (isset($_GET["id"])) ? $_GET["id"] : null;
            /* Il faut un la class TopicManager car insérer un nouveau topic en bdd concerne le topic */
            $topicManager = new TopicManager();

            /* Il faut la class PostManager car insérer un nouveau message en bdd */
            $postManager = new PostManager();

            /* Ici, on ne redirige pas vers une view car la fonction ne retourne rien, c'est donc à la fonction du topic manager de rediriger */
            // $topicManager->insertTopic($id);
            //$data = ['username' => 'Squalli', 'password' => 'dfsyfshfbzeifbqefbq', 'email' => 'sql@gmail.com'];

            if(isset($_POST['submit'])){

                $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);
                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_SPECIAL_CHARS);

                /* On déclare une première fois la variable data, correspondant à ce qu'on veut insérer dans la table topic */
                $data = ['titre'=>$titre,'verrouillage'=>'0','categorie_id'=>$id,'user_id'=>'3'];
                // $topicManager->add($data);

                /* On attribue à la variable $last l'exécution de la fonction add pour insérer un topic */
                $last = $topicManager->add($data);

                /* On attribue une nouvelle valeur à $data, correspondant à ce qu'on veut insérer dans la table post (on veut insérer $last, car l'éxécution de l'insertion provoque un return sur le dernier id inséré en base de données (La méthode add de Manager renvoie à la méthode insert de DAO, qui retourne lastInsertId)) */
                $data = ['texte'=>$texte,'sujet_id'=>$last,'user_id'=>'3'];
                $postManager->add($data);

                
            }
            header('Location: index.php?ctrl=forum&action=detailCategorie&id='.$id.'');


        }

    }
