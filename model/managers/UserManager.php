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

    }