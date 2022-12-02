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


                                 /*******  INSCRIPTION **********/

        public function register(){


            $userManager = new UserManager();
            /* On vérifie qu'on reçoit les données saisies dans le formulaire concerné */
            if(isset($_POST['submit'])){

                /* On filtre les champs de saisie */
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_SPECIAL_CHARS);
                $mail = filter_input(INPUT_POST, "mail", FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
                $password2 = filter_input(INPUT_POST, "password2", FILTER_SANITIZE_SPECIAL_CHARS);

                if($pseudo && $mail && $password && $password2){

                    /* On vérifie que l'utilisateur n'existe pas (mail) && que le pseudo n'existe pas && que les deux password correspondent*/
                     if($userManager->mails($mail)==NULL && $userManager->pseudos($pseudo)==NULL && $password2===$password){
                       /* Si toutes les conditions du dessus sont vérifiées, on hash le mot de pass (le 1er car le 2eme sert uniquement à la comparaison) avec un algo (2eme parametre de la function) */
                        $passwordH = password_hash($password,PASSWORD_BCRYPT);
                        /* C'est le mot de passe haché que l'on stocke en bdd */
                        $userManager->add(['pseudo'=>$pseudo,'mail'=>$mail,'password'=>$passwordH,'role'=>"role"]);

                        return [
                            "view" => VIEW_DIR."/security/login.html"
                        ];  

                     }else{
                        echo "Les informations n'ont pas été saisies correctement ou le mail ou pseudo est déjà pris";
                        return [
                            "view" => VIEW_DIR."/security/listCategories.php"
                        ];  
                     }
                 }

            }

        }

                             /******* CONNEXION *********/

        public function login(){

            $userManager = new UserManager();

            /* On vérifie d'abord que le formulaire voulu a été saisi */
            if(isset($_POST['submit'])){

                /* On filtre les données */
                $mail = filter_input(INPUT_POST, "mail", FILTER_VALIDATE_EMAIL);
                $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

                if($mail && $password){

                    /* On recherche le mot de passe associé à l'adresse mail */
                    $userManager->findPasswordByMail($mail);

                    /* On recherche l'utilisateur rattaché à l'adresse mail */
                    $userManager->findUserByMail($mail);

                    /* On vérifie que les mots de passe concordent */
                    if(password_verify($password, $userManager->findPasswordByMail($mail))==TRUE){
                    /* Si les mots de passe concordent, on stocke l'user en Session (setUser dans App\Session) */      
                        echo "Bon password";
                      /* On redirige sur une page d'accueil */                    

                    }else{
                        echo "pas le bon password";
                    }
                    





                }

            }


            header('Location: index.php?ctrl=forum&action=listTopics');
         

        }



 }
