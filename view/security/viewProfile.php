<?php 
/* S'il y a des datas... */
$topics = $result["data"]['topics'];

// var_dump($activitesReverse);
// var_dump(array_count_values($activitesReverse));
// var_dump($_SESSION['activites']);
?>
<h4>Mon profil</h4>

<p>Pseudo : <?= $_SESSION["user"]->getPseudo() ?></p>

<p>Adresse e-mail : <?= $_SESSION["user"]->getMail() ?></p>
<br>
<ul>Mes dernières activités :
    <?php
        // Si des activités ont été enregistrées en $_SESSION...
        if(isset($_SESSION['activites'])){

            $activitesReverse = array_reverse($_SESSION['activites']);
            /* TROUVER UN MOYEN D AFFICHER LES 5 DERNIERES ACTIVITES */
                // $compteur = 1;
                // while($compteur <= 3){
                    foreach( $activitesReverse as $activite){

                        // var_dump($activite);
                        ?>
                            <li><?=($activite) ?></li>
                        <?php
                        // $compteur++;
                    }
                // }
                
        }else{
            ?>
                <p>Pas d'activité enregistrée</p>
            <?php
        }
    ?>
</ul>
<br>



<p>Mes sujets : </p>
<div id="mes-sujets">
<?php 
    foreach($topics as $topic){
    ?>
    <p><?=  $topic->getTitre()?>
        <?php
            if($topic->getVerrouillage()==0){
        ?>
                <a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId()?>">Clore le sujet</a>
        <?php
            }else{
        ?>
        Sujet clos
        <?php } ?>
    </p>
    <?php
    }
?>
</div>


