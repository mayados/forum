<?php

$topics = $result["data"]['topics'];
$categorie = $result["data"]['categorie'];

/* On peut récupérer l'id de la catégorie grâce à l'id placé dans le lien de la  page listCategories.php */
$idCategorie = (isset($_GET["id"])) ? $_GET["id"] : null;
if (!$topics == null) {


?>

    <div id="main-detailCategorie">
        <h1><?= $categorie->getNomCategorie() ?></h1>
        <a href="index.php?ctrl=forum&action=listCategories">Retour</a>   
        <div id="topics-bar">
            <div id="titre-bar">
                <p>Titre</p>
            </div>
            <div id="auteur-bar">
                <p>Auteur</p>
            </div>
            <div id="posts-bar">
                <p>Posts</p>
            </div>
            <div id="creation-bar">
                <p>Création</p>
            </div>
            <div id="etat-bar">
                <p>Etat</p>
            </div>
         </div> 
        
        <div id="list-topics">
            <?php
            foreach ($topics as $topic) {
            ?>
                <div class="topic-element">
                    <div class="topic-titre">
                        <a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId() ?>"><?= $topic->getTitre() ?></a>
                    </div>
                    <div class="topic-createur">
                        <?php
                        if ($topic->getUser() == false) {
                        ?>
                            <p>Utilisateur banni</p>
                        <?php
                        } else {
                        ?>
                            <a href="index.php?ctrl=security&action=viewProfileUsers&id=<?= $topic->getUser()->getId() ?>" ><?= $topic->getUser() ?></a>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="topic-nbPosts">
                        <p><i class="fa-regular fa-message"></i> <?= $topic->getCountPost() ?></p>
                    </div>
                    <div class="topic-date">
                        <p><?= $topic->getDateCreation() ?> </p>                        
                    </div>
                    <div class="topic-etat">
                        <?php
                        if(!App\Session::isAdmin()){
                            if($topic->getVerrouillage() == 0) {
                        ?>
                            <p>Ouvert</p>
                        <?php
                            }else{
                        ?>
                            <p>Clos</p>
                        <?php
                            }
                        }
                        ?>
                    </div>
                        <?php
                        if(App\Session::isAdmin()){
                            ?>
                    <div class="topic-verrouillage">
                            <?php
                            if ($topic->getVerrouillage() == 0) {
                        ?>
                            
                                <p><a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId() ?>&categorie=<?= $idCategorie ?>">Clore</a></p>
                            <?php
                            }else{
                            ?>
                                <p>Sujet clos</p>
                       
                        <?php
                            }
                        ?>
                    </div>     
                        <?php
                        }
                        ?>                        
                </div>
            <?php
            }
            ?>
        </div>
        <?php
            if(App\Session::getUser()){
        ?>
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
        <?php
            }
        ?>
    </div>
<?php
} else {
?>
    <div id="main-premierTopic">
        <h2>Pas de topics pour le moment...</h2>
        <div id="premierTopic">
            <h4>Créer le 1er topic :</h4>

            <form id="premierTopic-form" action="index.php?ctrl=forum&action=nouveauTopic&id=<?= $idCategorie ?>" method="post">

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

    </div>
<?php
}
?>