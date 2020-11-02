<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/profil.css">
        <link rel="stylesheet" href="css/les_questions.css">
    </head>
	<body>
        <?php
            require_once("includes/header.php");
            if(empty($_SESSION['pseudo'])){
                header('Location: index.php');
                exit();
            }

            // connexion à la base de données

            require_once("traitement/connexion_bdd.php");

            $profil = $connexion->query('SELECT Mail_profil, Genre_profil, Id_profil, Image_profil FROM profil WHERE Pseudo_profil = "'.$_SESSION['pseudo'].'"')->fetchAll();
		?>
		
		<!-- affichage des demandes d'amis -->

		<div class="amis">
			<h3>Demandes d'amis:</h3>
			<?php
				$existe = $connexion->query('SELECT Id_envoyeur from requete where Id_receveur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'") and Status_requete = "attente"')->fetchAll();

				if(count($existe) == 0){
					echo'vous n\'avez aucune requête d\'ami';
				}

				else{
					for ($i=0; $i < count($existe); $i++) {
						$utilisateur = $connexion->query('SELECT Pseudo_profil from profil where Id_profil = '.$existe[$i]['Id_envoyeur'])->fetchAll();

						echo'
							<p>Utilisateur: '.$utilisateur[0]['Pseudo_profil'].'</p>
							<p><a href="traitement/accepter.php?id='.$existe[0]['Id_envoyeur'].'">Accepter la demande</a></p>
							<p><a href="traitement/refuser.php?id='.$existe[0]['Id_envoyeur'].'">Refuser la demande</a></p>
						';
					}
				}
			?>

			<!-- envoi d'une demande d'ami -->

			<h3>envoyer une demande d'ami:</h3>
			<form method="POST">
				<input type="text" placeholder="Pseudo de l'utilisateur" name="pseudo">
				<input type="submit" value="envoyer" name="envoyer">

				<?php
					$pseudo = $connexion->query('SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'"')->fetchAll();

					// vérification des champs

					if(!empty($_POST['pseudo']) && isset($_POST['envoyer'])){
						$utilisateur = $connexion->query('SELECT Pseudo_profil from profil where Pseudo_profil = "'.$_POST['pseudo'].'"')->fetchAll();

						// si l'utilisateur existe

						if(count($utilisateur) == 1){

							// si l'utilisateur n'est pas nous même

							if($utilisateur[0]['Pseudo_profil'] == $_SESSION['pseudo']){
								echo'Vous ne pouvez pas vous ajouter en ami';
							}

							else{
								// si une requête a déjà étée envoyée à cet utilisateur

								$existe = $connexion->query('SELECT Id_requete from requete where Id_envoyeur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'") and Id_receveur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_POST['pseudo'].'")')->fetchAll();

								if(count($existe) == 1){
									echo'Une demande a déjà été envoyée à cet utilisateur';
								}

								else{
									// si moi et cet utilisateur sommes déjà amis

									$existe = $connexion->query('SELECT Id_requete from requete where Id_envoyeur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_POST['pseudo'].'") and Id_receveur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'") and Status_requete = "acceptee"')->fetchAll();

									if(count($existe) == 1){
										echo'Vous êtes déjà ami avec cet utilisateur';
									}

									else{
										// si cet utilisateur vous a déjà envoyé une requête

										$existe = $connexion->query('SELECT Id_requete from requete where Id_envoyeur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_POST['pseudo'].'") and Id_receveur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'") and Status_requete = "attente"')->fetchAll();

										if(count($existe) == 1){
											$query = $connexion->prepare('UPDATE requete set Status_requete = "acceptee" where Id_envoyeur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_POST['pseudo'].'") and Id_receveur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'")');

											$query->execute();

											echo'Vous êtes maintenant ami avec '.$_POST['pseudo'];
										}

										else{
											$existe = $connexion->query('SELECT Id_requete from requete where Id_envoyeur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'") and Id_receveur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_POST['pseudo'].'") and Status_requete = "acceptee"')->fetchAll();

											if(count($existe) == 1){
												echo'Vous êtes déjà ami avec cet utilisateur';
											}

											else{
												$receveur = $connexion->query('SELECT Id_profil from profil where Pseudo_profil = "'.$_POST['pseudo'].'"')->fetchAll();

												$query = $connexion->prepare('INSERT INTO requete (Id_envoyeur, Id_receveur) VALUES (:Id_envoyeur, :Id_receveur)');

												$query->bindParam(':Id_envoyeur', $Id_envoyeur);
												$query->bindParam(':Id_receveur', $Id_receveur);

												$Id_envoyeur = $pseudo[0]['Id_profil'];
												$Id_receveur = $receveur[0]['Id_profil'];

												$query->execute();

												echo'La demande a bien été envoyée';
											}
										}
									}
								}
							}
						}

						else{
							echo'cet utilisateur n\'existe pas';
						}
					}
				?>
			</form>
		</div>

		<!-- affichage de la liste d'amis -->

		<div>
			<h3>Amis:</h3>
			<?php
				$amis = $connexion->query('SELECT Id_envoyeur, Id_receveur from requete where Status_requete = "acceptee" and (Id_envoyeur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'") or Id_receveur = (SELECT Id_profil from profil where Pseudo_profil = "'.$_SESSION['pseudo'].'"))')->fetchAll();

				for ($i=0; $i < count($amis); $i++){
					if($amis[$i]['Id_envoyeur'] == $pseudo[0]['Id_profil']){
						$ami = $connexion->query('SELECT Pseudo_profil from profil where Id_profil = '.$amis[$i]['Id_receveur'])->fetchAll();
						echo '<p>'.$ami[0]['Pseudo_profil'].'</p>';
					}
					else{
						$ami = $connexion->query('SELECT Pseudo_profil from profil where Id_profil = '.$amis[$i]['Id_envoyeur'])->fetchAll();
						echo '<p>'.$ami[0]['Pseudo_profil'].'</p>';
					}
				}
			?>
		</div>

		<!-- avatar -->

        <h1>Bonjour, <?php echo''.$_SESSION['pseudo'].''; ?>!</h1>
		<div class="col-lg-3 avatar name-div">
			<?php echo'<img src="'.$profil[0]['Image_profil'].'" class="image">'; ?>
		</div>

		<!-- espacement de 2 colones entre nos div -->

		<div class="col-md-2 name-div"><br></div>
		<form method="POST">
			<div class="col-md-4 name-div tout">
				<p class="saut-ligne">pseudo : 
					<?php   
						echo $_SESSION['pseudo'];
					?>
				</p>
				<input type="text" placeholder="modifer votre pseudo" name="nom" class="col-7">
				<p class="saut-ligne">e-mail : 
					<?php 
						echo $profil[0]['Mail_profil'];
					?> 
				</p>
				<input type="email" placeholder="modifer votre adresse email" name="email" class="col-7">
				<p class="saut-ligne">genre : 
					<?php 
						echo $profil[0]['Genre_profil'];
					?>
				</p>
				<select name="genre" class="col-3">
					<option value="homme" <?php if($profil[0]['Genre_profil'] == "homme") echo "selected='selected'"; ?>>homme</option>
					<option value="femme" <?php if($profil[0]['Genre_profil'] == "femme") echo "selected='selected'"; ?>>femme</option>
					<option value="autre" <?php if($profil[0]['Genre_profil'] == "autre") echo "selected='selected'"; ?>>autre</option>
				</select>
				<br>
				<input type="text" placeholder="Saisir le nouveau lien de votre image de profil" name="image" class="col-7 mt-5">
				<input type="submit" value="envoyer" class="col-5 mt-5 mb-5" name="valider">
			</div>
		</form>

		<?php
			require_once("traitement/connexion_bdd.php");

            if(isset($_POST['valider'])){
                if(!empty($_POST['nom'])){
					$_SESSION['pseudo'] = $_POST['nom'];
                    $query = $connexion->prepare('UPDATE profil SET Pseudo_profil = :nom WHERE Id_profil = "'.$profil[0]['Id_profil'].'"');
                    $query->bindParam(':nom', $_POST['nom']);
					$query->execute();
					header("Refresh:0");
                }
                if(!empty($_POST['email'])){
                    $query = $connexion->prepare('UPDATE profil SET Mail_profil = :email WHERE Id_profil = "'.$profil[0]['Id_profil'].'"');
                    $query->bindParam(':email', $_POST['email']);
					$query->execute();
					header("Refresh:0");
                }
                if(!empty($_POST['genre'])){
                    $query = $connexion->prepare('UPDATE profil SET Genre_profil = :genre WHERE Id_profil = "'.$profil[0]['Id_profil'].'"');
                    $query->bindParam(':genre', $_POST['genre']);
					$query->execute();
					header("Refresh:0");
				}
				if(!empty($_POST['image'])){
                    $query = $connexion->prepare('UPDATE profil SET Image_profil = :image WHERE Id_profil = "'.$profil[0]['Id_profil'].'"');
                    $query->bindParam(':image', $_POST['image']);
					$query->execute();
					header("Refresh:0");
                }
            }
		?>
        
        <main class="main">
            <h1>Questions posées par l'utilisateur :</h1>
            <?php

                //recupération de toutes les questions de l'utilisateur

                $question = $connexion->query('SELECT * FROM question WHERE Id_profil = '.$profil[0]['Id_profil'].' ORDER BY Date_creation_question')->fetchAll();

                for($i = 0; $i < count($question); $i++){

                    //récupération des categories, des profils, et des réponses correspondant aux questions

                    $categorie = $connexion->query('SELECT Libelle_categorie FROM categorie WHERE Id_categorie = '.$question[$i][4])->fetchAll();
                    $profil = $connexion->query('SELECT Pseudo_profil, Image_profil FROM profil WHERE Id_profil = '.$question[$i][3])->fetchAll();
                    $reponse = $connexion->query('SELECT COUNT(*) FROM reponse WHERE Id_question = '.$question[$i][0])->fetchAll();

                    //affichage des questions

                    echo'
                    <div class="question">
                        <img class="profile_pic_question" src="'.$profil[0]['Image_profil'].'">
                        <div class="description">
                            <p>'.$profil[0][0].'</p>
                            <p> | </p>
                            <p>'.$reponse[0][0].' avis</p>
                            <p> | </p>
                            <p>'.$categorie[0][0].'</p>
                            <p> | </p>
                            <p>'.$question[$i][2].'</p>
                        </div>
                        <div class="triangle"></div>
                        <p class="question_text"><a href="question.php?id=' . $question[$i][0] . '">'.$question[$i][1].'</a></p>
                        <br><br>
                    </div>';
                }
            ?>
        </main>
	</body>
</html>