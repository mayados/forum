<?php
    namespace Model\Entities;

    use App\Entity;

    /* Une class final est une class qui ne peut pas être étendue (on peut s'en passer, c'est juste pour rendre le code plus stricte) */
    final class User extends Entity{

        private $id;
        private $pseudo;
        private $mail;
        private $password;
        private $dateInscription;
        private $role;

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
         * Get the value of title
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of title
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        /**
         * Get the value of user
         */ 
        public function getMail()
        {
                return $this->mail;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setMail($mail)
        {
                $this->mail = $mail;

                return $this;
        }

                /**
         * Get the value of user
         */ 
        public function getPassword()
        {
                return $this->password;
        }

        /**
         * Set the value of user
         *
         * @return  self
         */ 
        public function setPassword($password)
        {
                $this->password = $password;

                return $this;
        }

        public function getDateInscription(){
            $formattedDate = $this->dateInscription->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setDateInscription($date){
            $this->dateInscription = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of closed
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of closed
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        public function hasRole($role){
                // var_dump($role);die;
                if($this->role === $role){
                        return true;
                }else{
                        return false;
                }
        }

        public function __toString()
        {
                return $this->pseudo;
        }
    }
