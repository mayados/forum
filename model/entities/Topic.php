<?php
    namespace Model\Entities;

    use App\Entity;

    /* Une class final est une class qui ne peut pas être étendue (on peut s'en passer, c'est juste pour rendre le code plus stricte) */
    final class Topic extends Entity{

        private $id;
        private $titre;
        private $membre;
        private $dateCreation;
        private $verrouillage;
        private $categorie;

        /* Prend des tableaux associatifs et les transforme en objets ou tableaux d'objets (exemple : pour accéder à une propriété on va manipuler une méthode de l'objet ex ->get...) */
        public function __construct($data){         
            $this->hydrate($data);  
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of titre
         */ 
        public function getTitre()
        {
                return $this->titre;
        }

        /**
         * Set the value of titre
         *
         * @return  self
         */ 
        public function setTitre($titre)
        {
                $this->titre = $titre;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getMembre()
        {
                return $this->membre;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setMembre($membre)
        {
                $this->membre = $membre;

                return $this;
        }

        public function getDateCreation(){
            $formattedDate = $this->dateCreation->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setDateCreation($date){
            $this->dateCreation = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of closed
         */ 
        public function getVerrouillage()
        {
                return $this->verrouillage;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */ 
        public function setVerrouillage($verrouillage)
        {
                $this->verrouillage = $verrouillage;

                return $this;
        }

                /**
         * Get the value of closed
         */ 
        public function getCategorie()
        {
                return $this->categorie;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */ 
        public function setCategorie($categorie)
        {
                $this->categorie = $categorie;

                return $this;
        }
    }
