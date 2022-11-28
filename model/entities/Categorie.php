<?php
    namespace Model\Entities;

    use App\Entity;

    /* Une class final est une class qui ne peut pas être étendue (on peut s'en passer, c'est juste pour rendre le code plus stricte) */
    final class Categorie extends Entity{

        private $id;
        private $nomCategorie;

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
         * Get the value of nomCategorie
         */ 
        public function getNomCategorie()
        {
                return $this->nomCategorie;
        }

        /**
         * Set the value of nomCategorie
         *
         * @return  self
         */ 
        public function setNomCategorie($nomCategorie)
        {
                $this->nomCategorie = $nomCategorie;

                return $this;
        }

    }
