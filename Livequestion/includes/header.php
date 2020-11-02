<?php 
    session_start();
?>
<link rel="stylesheet" href="css/header.css">
<nav class="nav sticky-top bg-light">
    <p class="titre">Livequestion</p>
    <p class="questions"><a href="les_questions.php?page=1">Les questions</a></p>
    <p class="ask_question"><a href="ask_question.php">Poser une question</a></p>
    <?php

        //connexion à la base de données
        require_once("traitement/connexion_bdd.php");

        $profil = $connexion->query('SELECT Id_profil FROM profil WHERE Pseudo_profil = "'.$_SESSION['pseudo'].'"')->fetchAll();
    
            if(!empty($_SESSION['pseudo'])){
            echo'<p class="bonjour">Bonjour '.$_SESSION['pseudo'].'</p><p><a href="index.php">Déconnexion</a></p>
            <p class="profil"><a href="profil.php">Profil</a></p>
            <p><a href="desinscription.php?id='.$profil[0]['Id_profil'].'">Désinscription</a></p>';
        }
        else{
            echo'<p><a href="connexion.php">Se connecter</a></p>';
        }
    ?>
</nav>