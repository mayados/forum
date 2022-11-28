<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    /* Topic Manager hérite de la class Manager pour bénéficier des méthodes pré-établies : findAll, findOneById.. */
    class TopicManager extends Manager{

        /* Nom de la class dans le dossier enities */
        protected $className = "Model\Entities\Topic";
        /* Nom de la table en base de données */
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }


    }