<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;

    /* UserManager hérite de la class Manager pour bénéficier des méthodes pré-établies : findAll, findOneById.. */
    class UserManager extends Manager{

        /* Nom de la class dans le dossier enities */
        protected $className = "Model\Entities\User";
        /* Nom de la table en base de données */
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function mails($mail){
            $sql = "SELECT mail
            FROM ".$this->tableName."
            WHERE mail = :mail";

            return $this->getOneOrNullResult(
                /* On passe un tableau associatif pour éviter la faille d'injection sql  */
                DAO::select($sql, ['mail' => $mail], false),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );
        
        }

        public function pseudos($pseudo){
            $sql = "SELECT pseudo
            FROM ".$this->tableName."
            WHERE pseudo = :pseudo";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['pseudo' => $pseudo]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );
        
        }

        /*******  RECHERCHER LE MOT DE PASSE ASSOCIE AU MAIL *******/
        public function findPasswordByMail($mail){

            $sql = "SELECT password
            FROM ".$this->tableName."
            WHERE mail = :mail";

            return $this->getSingleScalarResult(
                DAO::select($sql, ['mail' => $mail]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );

        }

        public function findUserByMail($mail){

            $sql = "SELECT *
            FROM ".$this->tableName."
            WHERE mail = :mail";

            return $this->getOneOrNullResult(
                /* Pas oublier de mettre le false ici car sinon ça met null */
                DAO::select($sql, ['mail' => $mail], false),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );

        }


    }