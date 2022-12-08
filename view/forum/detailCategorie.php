<?php

$topics = $result["data"]['topics'];

if(!$topics==null){
/* On peut récupérer l'id de la catégorie grâce à l'id placé dans le lien de la  page listCategories.php */
$idCategorie = (isset($_GET["id"])) ? $_GET["id"] : null;
    
?>

<div id="main-detailcategorie">
    <div id="list-topics">
        <h1>Liste des topics</h1>
        <?php
        foreach($topics as $topic ){

            ?>
            <a class="topic" href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>">
                <p><?=$topic->getTitre()?></p>
                <p>(posté par 
                    <?php
                        if($topic->getUser()==false){
                            ?>
                            Utilisateur banni
                            <?php
                        }else{
                        ?>
                        <?=$topic->getUser()?>)
                        <?php
                        }
                        ?>
                </p>  
                <p><?= $topic->getDateCreation() ?> </p> 
                <?php
                    if(App\Session::isAdmin()){
                        if($topic->getVerrouillage()==0){
                ?>
                    <a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId()?>&categorie=<?= $idCategorie ?>">Clore</a>
                <?php
                        }else{
                        ?>
                            <p>Sujet clos</p>
                        <?php
                        }
                    }
                ?>
            </a> 
            <?php
        }
        ?>    
    </div>
    <div id="ajout-topic">
        <h4>Ajouter un nouveau topic :</h4>


        <form id="form-topic" action="index.php?ctrl=forum&action=nouveauTopic&id=<?= $idCategorie ?>" method="post">

            <div class="form-field">
                <label for="titre">Titre du topic :</label>
                <input type="text" id="titre" name="titre" maxlength="80" required>                
            </div>
            <div class="form-field">
                <label for="texte">Message</label>
                <textarea name="texte" id="texte" cols="30" rows="10" required></textarea>                
            </div>

            <div class="form-field">
                 <input class="form-button" name="submit" type="submit" value="Envoyer">                
            </div>
        </form>             
    </div>
</div>
<?php
}else{
    ?>
    <h2>Pas de topics pour le moment...</h2>
    <div id="premier-topic">
        <h4>Créer le 1er topic :</h4>

        <form id="form-topic" action="index.php?ctrl=forum&action=nouveauTopic&id=<?= $idCategorie ?>" method="post">

            <div class="form-field">
                <label for="titre">Titre du topic :</label>
                <input type="text" id="titre" name="titre" maxlength="80" required>                
            </div>
            <div class="form-field">
                <label for="texte">Message</label>
                <textarea name="texte" id="texte" cols="30" rows="10" required></textarea>                
            </div>

            <div class="form-field">
                 <input class="form-button" name="submit" type="submit" value="Envoyer">                
            </div>
        </form>             
    </div>
</div>
    <?php
}
?>
