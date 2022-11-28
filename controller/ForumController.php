<?php
    /* Les controllers se contentent de réceptionner la requête demandée par le client, interrogent le manager adéquat, et envoient les infos à la vue */

    /* cette class sera contenue dans le namespace Controller */
    namespace Controller;

    /* Nous utilisons ces class, situées dans des namespace spécifiques */
    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    /* ForumController a pour class mère AbstractController */
    /* On utlise la méthode index() vide créée dans ControllerInterface */
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          

           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll(["dateCreation", "DESC"])
                ]
            ];
        
        }

        

    }
