<?php

$topics = $result["data"]['topics'];
$categorie = $result["data"]['categorie'];

/* On peut récupérer l'id de la catégorie grâce à l'id placé dans le lien de la  page listCategories.php */
$idCategorie = (isset($_GET["id"])) ? $_GET["id"] : null;
if (!$topics == null) {


?>

    <div id="main-detailCategorie">
        <div id="list-topics">
            <h1><?= $categorie->getNomCategorie() ?></h1>
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
                    <div class="topic-date">
                        <p><?= $topic->getDateCreation() ?> </p>                        
                    </div>
                    <div class="topic-etat">
                        <?php
                            if ($topic->getVerrouillage() == NULL) {
                        ?>
                            <p>Ouvert</p>
                        <?php
                            }else{
                        ?>
                            <p>Clos</p>
                        <?php
                            }
                        ?>
                    </div>
                        <?php
                        if (App\Session::isAdmin()) {
                            if ($topic->getVerrouillage() == NULL) {
                        ?>
                            <div class="topic-verrouillage">
                                <a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId() ?>&categorie=<?= $idCategorie ?>">Clore</a>
                            <?php
                            } else {
                            ?>
                                <p>Sujet clos</p>
                            </div>    
                        <?php
                            }
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