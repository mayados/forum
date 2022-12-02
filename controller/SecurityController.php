<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){
            
                return [
                    "view" => VIEW_DIR."home.php"
                ];
            }       
            
            
        public function register(){
            /* On vérifie qu'on reçoit les données saisies dans le formulaire concerné */

            /* On filtre les champs de saisie */

            /* On vérifie que l'utilisateur n'existe pas (mail) */

            /* On vérifie que le pseudo n'existe pas */

            /* On vérifie que les deux password correspondent */

            /* On hash le password */

            /* On ajoute l'user en bdd */

            /* Redirection dans la foulée vers le formulaire de connexion */
            return [
                "view" => VIEW_DIR."forum/login.html"
            ];

        }
   

    }
