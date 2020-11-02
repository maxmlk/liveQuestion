<<<<<<< HEAD
<?php
    session_start();
    require_once('connexion_bdd.php');

    $query = $connexion->prepare('UPDATE requete set Status_requete = "refusee" where Id_envoyeur = '.$_GET['id'].' and Id_receveur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'")');
    $query->execute();

    header('location: http://localhost/Livequestion-master/profil.php');
?>