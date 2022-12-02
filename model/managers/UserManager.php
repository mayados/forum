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
                DAO::select($sql, ['mail' => $mail]),
                /* On retourne l'objet, c'est pour ça qu'on ajoute la ligne ci-dessous */
                $this->className
            );
        
        }



    }