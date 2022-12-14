<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\CategorieManager;
    
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
                        $userManager->add(['pseudo'=>$pseudo,'mail'=>$mail,'password'=>$passwordH,'role'=>"user"]);

                        return [
                            "view" => VIEW_DIR."/security/login.html"
                        ];  

                     }else{
                        Session::addFlash('error',"Les informations n'ont pas été saisies correctement ou le mail ou pseudo est déjà pris");
                        $this->redirectTo("security","directionInscription");
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
                            }else{
                                 /* Si le password correspond pas avec celui de la bdd on envoie un message d'erreur */
                                 Session::addFlash('error','Informations incorrectes');
                                $this->redirectTo("security","directionConnexion");     
                            }
                        }
                    }else
                                $this->redirectTo("security","directionConnexion");   
                }
        }
        }

        public function viewProfile(){

            $id = (isset($_GET["id"])) ? $_GET["id"] : null;
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR . "security/viewProfile.php",
                "data" => [
                    "topics" => $topicManager->findTopicsByUser($id),
                    "lastTopics" => $topicManager->findLastTopics($id),
                    "lastPosts" =>  $postManager->findLastPosts($id)
                    ]
            ];

        }

        public function viewProfileUsers($id){

            // $id = (isset($_GET["id"])) ? $_GET["id"] : null;

            $userManager = new UserManager();
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR . "security/usersProfile.php",
                "data" => [
                    "users" => $userManager->findOneById($id),
                    "topics"=>$topicManager->findTopicsByUser($id),
                    "lastPosts" =>  $postManager->findLastPosts($id)
                    ]
            ];



        }

        public function deconnexion(){
            /* On enlève les données contenues dans $_SESSION["user"] */
            unset($_SESSION['user']);
            Session::addFlash('success','Déconnecté avec succés');

            return [
                "view" => VIEW_DIR . "home.php"
            ];

        }

        public function ban(){

            $this->restrictTo("admin");

            $id = (isset($_GET["id"])) ? $_GET["id"] : null;

            $userManager = new UserManager();

            $userManager->delete($id);

            Session::addFlash('success','Utilisateur banni');

            $this->redirectTo("security","users");   

        }

        /* Il faut supprimer le topic et les messages associés (sinon ça va prendre de la place pour rien en bdd) */
        public function deleteTopicAndPosts(){

            $this->restrictTo("admin");

            $id = (isset($_GET["id"])) ? $_GET["id"] : null;

            $topicManager = new TopicManager();
            $postManager = new PostManager();

            $postManager->deletePostsByTopic($id);
            $topicManager->delete($id);

            Session::addFlash('success','Sujet supprimé');

            $this->redirectTo("forum","listTopics");


        }

        public function deletePost(){

            $this->restrictTo("admin");

            $id = (isset($_GET["id"])) ? $_GET["id"] : null;

            $idTopic = (isset($_GET["idTopic"])) ? $_GET["idTopic"] : null;


            $postManager = new PostManager();

            $postManager->delete($id);

            $this->redirectTo("forum","detailTopic", $idTopic);

        }

        /* Fonction pour créer une nouvelle catégorie en tant qu'admin */
        public function nouvelleCategorie(){
            $this->restrictTo("admin");

            if(isset($_POST['submit'])){

                $nomCategorie = filter_input(INPUT_POST, "nomCategorie", FILTER_SANITIZE_SPECIAL_CHARS);

                if($nomCategorie){

                     $categorieManager = new CategorieManager();

                    /* On déclare une première fois la variable data, correspondant à ce qu'on veut insérer dans la table topic */
                    $data = ['nomCategorie'=>$nomCategorie];

                     $categorieManager->add($data);
                }
            }
            $this->redirectTo("forum","listCategories");   
        }


        public function closeTopic(){
            /* On ne restreint pas cette fonction, car l'utilisateur en session peut également clore ses sujets */

            $id = (isset($_GET["id"])) ? $_GET["id"] : null;

            $topicManager = new TopicManager();

            /* On fait passer l'id du topic concerné */
            $topicManager->closeTopic($id);

            Session::addFlash('success','Sujet clos avec succès');
            $this->redirectTo("forum","detailTopic", $id);

        }

        public function viewModifierTopic(){

            $topicManager = new TopicManager();
            $postManager = new PostManager();

            $id = (isset($_GET["id"])) ? $_GET["id"] : null;

            return [
                "view" => VIEW_DIR . "security/modifierTopic.php",
                "data" => [
                "topic" => $topicManager->findOneById($id),
                "post" => $postManager->firstPostByTopic($id)
                ]
            ];
        }


        public function updateTopic(){

            $id = (isset($_GET["id"])) ? $_GET["id"] : null;

            $topicManager = new TopicManager();
            $postManager = new PostManager();

            if(isset($_POST['submit'])){

                $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_SPECIAL_CHARS);
                $texte = filter_input(INPUT_POST, "texte", FILTER_SANITIZE_SPECIAL_CHARS);

                if($titre && $texte){

                    //RECUPERER L ID DU MESSAGE SINON CA MODIFIE TOUS LES MESSAGES DU SUJET
                    // $topicManager->updateTopic($id,$titre);
                    // $postManager->updateFirstPostTopic($id,$texte);

                }
            }

            $this->redirectTo("forum","detailTopic", $id);
        }


}
