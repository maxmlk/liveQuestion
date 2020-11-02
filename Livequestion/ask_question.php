<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/ask_question.css">
        <title>Poser une question</title>
    </head>
    <body class="body">
        <?php

            //affichage du header

            require_once("includes/header.php");

            //connexion à la base de données

            require_once("traitement/connexion_bdd.php");
        ?>
        <main class="main">
            <h1 class="page_title">Poser une question à la communauté</h1>

            <!-- formulaire de question -->

            <form method="POST">
                <div class="options">
                    <p>Quelle est votre question ?<span class="required">*</span></p>
                    <input type="text" class="form-text" name="libelle">

                    <p>Catégorie de la question<span class="required">*</span></p>
                    <select class="form-text" name="categories">
                        <option value = "vide"></option>

                        <!-- affichage des catégories -->

                        <?php
							$categories = $connexion->query('SELECT Id_categorie, Libelle_categorie FROM categorie')->fetchAll();

                            for($i = 0; $i < count($categories); $i++){
                                echo '<option value="'.$categories[$i]['Id_categorie'].'">'.$categories[$i]['Libelle_categorie'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <br>
                <label for="amis">Poser cette question uniquement à vos amis</label>
                <input type="checkbox" name="amis">
                <br>
                <input type="submit" class="button" name="valider">
            </form>

            <?php
                $profil = $connexion->query('SELECT Pseudo_profil, Id_profil FROM profil WHERE Pseudo_profil = "'.$_SESSION['pseudo'].'"')->fetchAll();

                //vérification des champs et envoi des données

                if(isset($_POST["valider"]) && (empty($_POST["libelle"]) || $_POST["categories"] == "vide")){
                    echo'Veuillez remplir tous les champs';
                }

                elseif(isset($_POST["valider"]) && !empty($_POST["libelle"])){
                    if(isset($_POST['amis']) && !empty($_POST['amis'])){
                        $query = $connexion->prepare('INSERT INTO question (Titre_question, Date_creation_question, Id_profil, Id_categorie, Amis_seulement) VALUES (:Titre_question, :Date_creation_question, :Id_profil, :Id_categorie, :Amis_seulement)');

                        $query->bindParam(':Amis_seulement', $Amis_seulement);
                        $Amis_seulement = 1;
                    }
                    else{
                        $query = $connexion->prepare('INSERT INTO question (Titre_question, Date_creation_question, Id_profil, Id_categorie) VALUES (:Titre_question, :Date_creation_question, :Id_profil, :Id_categorie)');
                    }

                    $query->bindParam(':Titre_question', $titre_question);
                    $query->bindParam(':Id_profil', $id_profil);
                    $query->bindParam(':Id_categorie', $id_categorie);
                    $query->bindParam(':Date_creation_question', $date_creation_question);

                    $date = new DateTime();

                    $titre_question = $_POST['libelle'];
                    $id_profil = $profil[0]['Id_profil'];
                    $id_categorie = $_POST['categories'];
                    $date_creation_question = $date->format('Y-m-d');

                    $query->execute();
                    echo'<p class="text-center">Votre question a bien été envoyée</p>';
                }
            ?>
        </main>
    </body>
</html>