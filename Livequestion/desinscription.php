<!DOCTYPE html>
<?php

    if(!empty($_GET['id']))
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST))
    {
        $id = checkInput($_POST['id']);
        require_once("traitement/connexion_bdd.php");
        $deleteQuestions = $connexion->prepare("DELETE FROM question WHERE Id_profil = ?");
        $deleteQuestions->execute(array($id));
        $deleteReponses = $connexion->prepare("DELETE FROM reponse WHERE Id_profil = ?");
        $deleteReponses->execute(array($id));
        $statement = $connexion->prepare("DELETE FROM profil WHERE Id_profil = ?");
        $statement->execute(array($id));
        header('Location: index.php');
    }

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="css/question.css">
        <title>Postez une réponse</title>
    </head>
    <body class="body">
        <header>
            <?php

                //affichage du header
                require_once("includes/header.php");

            ?>
        </header>

        <h1>Bonjour, <?php echo''.$_SESSION['pseudo'].''; ?>!</h1>
        
		<form class="form" role="form" action="desinscription.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
            <p class="alert alert-warning">Êtes-vous sûr de vouloir vous désinscrire ? Ceci entraînera la suppression de toutes vos questions/réponses.</p>
        <div class="form-actions">
            <button type="submit" class="btn btn-warning"><i class="fas fa-trash-alt"></i> Oui</button>
            <a class="btn btn-default" href="les_questions.php?page=1"><i class="fas fa-long-arrow-alt-left"></i> Non</a>
        </div>
        </form>
    </body>
</html>