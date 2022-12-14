<?php

$topics = $result["data"]['topics'];
?>

<div id="main-listTopics">
         <h1>Topics</h1> 
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
    <div id="topics-list">
        
            <?php
            foreach($topics as $topic ){
                                // var_dump($topic->getUser()->getBannir());

                ?>
                <div class="topic-element">
                    <div class="topic-titre">
                        <p><a href="index.php?ctrl=forum&action=detailTopic&id=<?= $topic->getId()?>"><?=$topic->getTitre()?></a></p>
                    </div>
                    <div class="topic-createur">
                        <?php
                            if($topic->getUser()->getBannir()==1){
                            ?>
                                <p>Utilisateur banni</p>
                            <?php
                            }else{
                        ?>
                        <a href="index.php?ctrl=security&action=viewProfileUsers&id=<?= $topic->getUser()->getId() ?>"><?=$topic->getUser()->getPseudo()?></a>
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
                            if ($topic->getVerrouillage() == 0) {
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
                            if($topic->getVerrouillage()== 0){
                                ?>
                             
                                    <p><a href="index.php?ctrl=security&action=closeTopic&id=<?= $topic->getId()?>">Clore</a></p>
                                <?php
                            }else{
                                ?>
                                    <p>Sujet clos</p>

                                <?php
                            }
                            ?>
                     </div>  
                     <div class="supprimer-sujet">
                        <a href="index.php?ctrl=security&action=deleteTopicAndPosts&id=<?= $topic->getId()?>">Supprimer</a>
                    </div>
                        <?php
                        }
                        ?>                        
                               
                </div>

                <?php
                /* Quand on fait un var_dump de $topic->getUser, on voit qu'il récupère l'objet associé (user), il n'y a donc plus qu'à mettre la propriété que nous souhaitons à partir de cet objet (ici ->getPseudo()) */
                // var_dump($topic->getUser());
            }
            ?>            
    </div>
   
</div>







