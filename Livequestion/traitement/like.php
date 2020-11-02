<<<<<<< HEAD
<?php
    session_start();
    require_once("connexion_bdd.php");

    $profil = $connexion->query('SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'"')->fetchAll();
    $liked = $connexion->query('SELECT Id_like from likes where Id_question = '.$_GET['id'].' AND Id_likeur = '.$profil[0][0])->fetchAll();
    $likes = $connexion->query('SELECT Id_question, Id_likeur from likes')->fetchAll();

    if(count($liked) === 0){
        $query = $connexion->prepare('INSERT INTO likes (Id_question, Id_likeur) VALUES (:Id_question, :Id_likeur)');

        $query->bindParam(':Id_question', $Id_question);
        $query->bindParam(':Id_likeur', $Id_likeur);

        $Id_question = $_GET['id'];
        $Id_likeur = $profil[0][0];

        $query->execute();

        header('location: http://localhost/livequestion-master/question.php?id='.$_GET['id']);
        exit();
    }

    else{
        $query = $connexion->prepare('DELETE from likes where Id_question = '.$_GET['id'].' AND Id_likeur = '.$profil[0][0]);
        $query->execute();

        header('location: http://localhost/livequestion-master/question.php?id='.$_GET['id']);
        exit();
    }
?>