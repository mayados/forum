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

            public function directionInscription(){
                return [
                    "view" => VIEW_DIR."security/register.html"
                ]; 
            }

            
            public function directionConnexion(){
                return [
                    "view" => VIEW_DIR."security/login.html"
                ]; 
            }

        public function register(){


            $userManager = new UserManager();
            /* On vérifie qu'on reçoit les données saisies dans le formulaire concerné */
            if(isset($_POST['submit'])){

                /* On filtre les champs de saisie */
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_SPECIAL_CHARS);
                $mail = filter_input(INPUT_POST, "mail", FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
                if($pseudo && $mail && $password){

                    /* On vérifie que l'utilisateur n'existe pas (mail) */
                     if($userManager->mails($mail)==0){
                          var_dump("non enregistré");
                     }else{
                        var_dump("deja enregistre");
                     }

                     /* On vérifie que le pseudo n'existe pas */

                     /* On vérifie que les deux password correspondent */

                     /* On hash le password */

                     /* On ajoute l'user en bdd */

                     /* Redirection dans la foulée vers le formulaire de connexion */

                 }


                return [
                    "view" => VIEW_DIR."/security/login.html"
                ];

            }

        }

 }
