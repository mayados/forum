<?php
    /* Espace dans lequel il est situé et par lequel on l'appelera ailleurs */
    namespace App;

    abstract class AbstractController{

        public function index(){}
        
        /* fonction de redirection */
        public function redirectTo($ctrl = null, $action = null, $id = null){

            if($ctrl != "home"){
                $url = $ctrl ? "/".$ctrl : "";
                $url.= $action ? "/".$action : "";
                $url.= $id ? "/".$id : "";
                $url.= ".html";
            }
            else $url = "/";
            header("Location: $url");
            die();

        }

        public function restrictTo($role){
            /* Si on obtient pas l'identité de l'utilisateur, on redirige vers la page de connexion ?  */
            if(!Session::getUser() || !Session::getUser()->hasRole($role)){
                $this->redirectTo("security", "login");
            }
            return;
        }

    }