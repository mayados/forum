<h1>BIENVENUE SUR LE FORUM</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>

<?php
    /* S'il y a déjà un utilisateur dans la $_SESSION, on affiche Déconnexion */
    if(App\Session::getUser()){
    ?>
        <a href="index.php?ctrl=security&action=viewProfile"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()?></a>
        <a href="index.php?ctrl=security&action=deconnexion">Déconnexion</a>                        
        <?php
    }else{
        /* S'il n'y a pas d'utilisateur en SESSION, on propose de se connecter ou s'inscrire */
        ?>
        <a href="view/security/login.html">Se connecter</a>
        <span>&nbsp;-&nbsp;</span>
        <a href="view/security/register.html">S'inscrire</a>       
    <?php
    }
?>
