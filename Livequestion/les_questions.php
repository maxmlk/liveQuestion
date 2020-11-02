<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/les_questions.css">
        <title>Page d'accueil de Livequestion</title>
    </head>
    <body class="body">
        <header>
            <?php
                $nb_questions = 30;

                // connexion à la base de données

                require_once("traitement/connexion_bdd.php");

                // recupération de toutes les questions

                $question = $connexion->query('SELECT * from question order by Id_question desc')->fetchAll();

                // affichage du header

                require_once("includes/header.php");

                // affichage de la pagination

                require("includes/pagination.php");
            ?>
        </header>
        <main class="main">
            <?php
                $amis = $connexion->query('SELECT Id_envoyeur, Id_receveur from requete where Status_requete = "acceptee" and (Id_envoyeur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'") or Id_receveur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'"))')->fetchAll();
				$ami = $connexion->query('SELECT Amis_seulement from question')->fetchAll();

                for($i = 0; $i < count($question)-$nb_questions*($_GET['page']-1) && $i < $nb_questions; $i++){

                    // récupération des informations correspondant aux questions

                    $categorie = $connexion->query('SELECT Libelle_categorie FROM categorie WHERE Id_categorie = '.$question[$i+$nb_questions*($_GET['page']-1)]['Id_categorie'])->fetchAll();
                    $profil = $connexion->query('SELECT Id_profil, Pseudo_profil, Image_profil FROM profil WHERE Id_profil = '.$question[$i+$nb_questions*($_GET['page']-1)]['Id_profil'])->fetchAll();
					$reponse = $connexion->query('SELECT COUNT(*) FROM reponse WHERE Id_question = '.$question[$i+$nb_questions*($_GET['page']-1)]['Id_question'])->fetchAll();

                    // vérification de si la question est en mode amis uniquement

                    $amisUniquement = 0;

                    for ($i2 = 0; $i2 < count($amis); $i2++){
                        if($amis[$i2]['Id_envoyeur'] == $_SESSION['id']){
                            if($amis[$i2]['Id_receveur'] == $profil[0]['Id_profil'] || $_SESSION['id'] == $profil[0]['Id_profil']){
                                $amisUniquement = 1;
                            }
                        }
                        elseif($amis[$i2]['Id_envoyeur'] == $profil[0]['Id_profil'] || $_SESSION['id'] == $profil[0]['Id_profil']){
                            $amisUniquement = 1;
						}
					}

                    // affichage des questions

                    if((($ami[$i+$nb_questions*($_GET['page']-1)]['Amis_seulement'] == 0) || ($ami[$i+$nb_questions*($_GET['page']-1)]['Amis_seulement'] == 1)) && $amisUniquement == 1){
                        echo'
                        <div class="question">
                            <img class="profile_pic_question" src="'.$profil[0]['Image_profil'].'">
                            <div class="description">
                                <p>'.$profil[0]['Pseudo_profil'].'</p>
                                <p> | </p>
                                <p>'.$reponse[0][0].' avis</p>
                                <p> | </p>
                                <p>'.$categorie[0]['Libelle_categorie'].'</p>
                                <p> | </p>
                                <p>'.$question[$i]['Date_creation_question'].'</p>
                            </div>
                            <div class="triangle"></div>
                            <p class="question_text"><a href="question.php?id=' . $question[$i+$nb_questions*($_GET['page']-1)]['Id_question'] . '">'.$question[$i+$nb_questions*($_GET['page']-1)]['Titre_question'].'</a></p>
                            <br><br>
                        </div>';
                    }
                }
            ?>
        </main>
        <?php
            // affichage de la pagination

            require("includes/pagination.php");
        ?>
    </body>
</html>