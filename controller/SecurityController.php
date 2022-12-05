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



            // $session = new Session();
            // var_dump($session);

            /* On vérifie d'abord que le formulaire voulu a été saisi */
            if(isset($_POST['submit'])){

                /* On filtre les données */
                $mail = filter_input(INPUT_POST, "mail", FILTER_VALIDATE_EMAIL);
                /* Le mdp en bdd est haché, il ne pourra pas être comparé s'il y a des filtres */
                $password = $_POST['password'];
                // var_dump("avant");die;  

                if($mail){
                   if($password){
                        $userManager = new UserManager();
                        /* On trouve le password associé au mail */
                        $getPass = $userManager->findPasswordByMail($mail);
                        /* On trouve l'utilisateur associé au mail */
                        $getUser = $userManager->findUserByMail($mail);
                    
                        // $userManager->findUserByMail($mail);

                        /* S'il y a un utilisateur par rapport au mail entré */
                        if($getUser){
                            /* Vérification du password entré avec le password haché en bdd */
                            $checkPassword = password_verify($password,$getPass['password']);

                            /* Si les passwords correspondent */
                            if($checkPassword){
                                // var_dump("test");
                                /* On ajoute l'utilisateur dans la session */
                                Session::setUser($getUser);
                                // var_dump($getUser);die;
                                /* On ajoute un message de succès */
                                Session::addFlash('success','Bienvenue');
                                /* On redirige vers la liste des catégories */
                                // header('Location: index.php?ctrl=forum&action=listCategories');
                                $this->redirectTo('home');
                            }
                        }else
                                /* S'il n'y a pas d'utilisateur trouvé avec le mail entré  on met un message d'erreur */
                                Session::addFlash('error','Aucun compte pour cet email');
                     }else
                                /* Si le password correspond pas avec celui de la bdd on envoie un message d'erreur */
                                Session::addFlash('error','Mot de passe incorrect');
                                header('Location: index.php?ctrl=security&action=directionConnexion');   
                 
                }

        }
     

        }



}
