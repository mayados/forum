

<div id="main-home">
    <h1>BIENVENUE</h1>
    <div id="forum-presentation">
        <p>Le forum est un endroit d'échange respectueux entre membres inscrits.
            Vous y trouverez des catégories et sujets variés. Vous avez également la possibilité de créer des sujets.
            Venez aider, lire ou partager.
            Venez rejoindre la communauté ! 
        </p>        
    </div>


    <?php
        /* S'il y a déjà un utilisateur dans la $_SESSION, on affiche Déconnexion */
        if(App\Session::getUser()){
        ?>
            <div class="bottom-links">
                <a href="index.php?ctrl=security&action=viewProfile"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?></a>
                <a href="index.php?ctrl=security&action=deconnexion">Déconnexion</a>                      
            </div>
                  
            <?php
        }else{
            /* S'il n'y a pas d'utilisateur en SESSION, on propose de se connecter ou s'inscrire */
            ?>
            <a href="index.php?ctrl=security&action=directionConnexion">Se connecter</a>
            <span>&nbsp;-&nbsp;</span>
            <a href="index.php?ctrl=security&action=directionInscription">S'inscrire</a>       
        <?php
        }
    ?>    
</div>


