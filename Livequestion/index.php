<!DOCTYPE html>
<?php
	session_start();
    $_SESSION['pseudo'] = '';
?>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/accueil.css">
		<script src="https://code.jquery.com/jquery-3.4.1.min.js"integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
		<title>Livequestion, Tristan, Maxence, Léo, Fabien</title>
	</head>
	<body>

		<!-- section du haut avec grande image -->

		<section class="main">
			<div class="accueil col-xl-8 col-10">
				<nav class="navbar">
					<h1 class="titre">Saint Vincent BTS 1</h1>
					<ul class="navbar-nav">
						<li class="nav-item">
							<a href="#" class="nav-link lien-nav">Lien1</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link lien-nav">Lien2</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link lien-nav">Lien3</a>
						</li>
						<li class="nav-item">
							<a href="#" class="nav-link lien-nav">Lien4</a>
						</li>
						<li class="nav-item">
							<div class="btn-connexion">
								<a href="connexion.php" class="nav-link">Se connecter</a>
							</div>
						</li>
						<div class="dropdown">
							<button type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fas fa-caret-down fa-3x"></i>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							  <a class="dropdown-item" href="#">Lien1</a>
							  <a class="dropdown-item" href="#">Lien2</a>
							  <a class="dropdown-item" href="#">Lien3</a>
							  <a class="dropdown-item" href="#">Lien4</a>
							</div>
						</div>
					</ul>
				</nav>
				<div class="presentation">
					<div class="texte-presentation">
						<h2 class="titre-presentation">Lorem ipsum dolor sit amet.</h2>
						<p class="para-presentation">Quod id modi obcaecati, eos officia odio numquam ex ipsa tenetur minima laborum facere soluta natus libero molestias, corrupti beatae maxime. Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos officia libero, quam reprehenderit ipsum nemo repellendus.</p>
						<div class="btn-cta">Bouton CTA</div>
					</div>
					<div class="image-presentation"></div>
				</div>
			</div>
		</section>
		<div class="arrondi_haut_presentation"></div>

		<!-- section sous la grande image -->

		<section class="main2">
			<div class="description-presentation col-xl-8 col-10 container-fluid">
				<div class="conteneur mr-5 container-fluid">
					<div class="icone-accueil eclair"></div>
					<h3 class="sous-titre-accueil">Suits Your Style</h3>
					<p class="para-accueil">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta at cum laudantium omnis. Amet saepe architecto dolorum voluptatibus aperiam? Nesciunt repudiandae cumque velit expedita eum quasi quisquam a, voluptatem veritatis.</p>
				</div>
				<div class="conteneur mr-5">
					<div class="icone-accueil marqueur"></div>
					<h3 class="sous-titre-accueil">Ut posuere molestie</h3>
					<p class="para-accueil">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, fuga. Perspiciatis reiciendis, eos commodi odio amet optio tempora sapiente ut porro voluptatibus repellat. Ex unde cum, aut ut excepturi suscipit.</p>
				</div>
				<div class="conteneur">
					<div class="icone-accueil cadre"></div>
					<h3 class="sous-titre-accueil">Vestibulum ut erat consectetur</h3>
					<p class="para-accueil">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae, voluptas iste dolor deserunt accusamus quis cum unde consequatur mollitia, deleniti asperiores laborum consequuntur. Autem quam illum fugit nostrum blanditiis eaque.</p>
				</div>
			</div>
		</section>
        
        		<!-- section AENEAN Magna Odio (avec les 3 onglets) -->
		<section class="main3">
		<div class="tout_faq2">
			<h1>Aenean magna odio</h1>
			<p class="phrases_haut_faq">Sed ut perspiciatis unde monis iste natus error sit voluptatem<br/>
            accusantium doloremque laudantium, totam rem aperiam, eaque ipsa.</p>
			<div class="questions_faq">
				<div class="imgcenter">
                	<a class="liensv" href="#lien1"> Lien 1 </a> <a class="liensv" href="#lien2"> Lien 2 </a> <a class="liensv" href="#lien3"> Lien 3 	</a>
                    <div class="liensv2">
                    	<p id="lien1"><img class='imgcenter' src='ressources/praesentvitae.png'></p>
                    	<p id="lien2"><img class='imgcenter' src='ressources/praesentvitae.png'></p>
                    	<p id="lien3"><img class='imgcenter' src='ressources/praesentvitae.png'></p>
                    </div>
                </div>
			</div>
		</div>
		</section>
		<!-- la partie faq -->
		<?php
			$questionsFAQ=[
				[
				'intitule_question_faq' => "Can I upgrade later on ?",
				'reponse_faq' => "lorem ipsum dolor sit amet",
				],
				[
				'intitule_question_faq' => "Can I port my data from another provider ?",
				'reponse_faq' => "lorem ipsum dolor sit amet",
				],
				[
				'intitule_question_faq' => "Are my food photos stored forever in the cloud ?",
				'reponse_faq' => "lorem ipsum dolor sit amet",
				],
				[
				'intitule_question_faq' => "Who foots the bill for that ?",
				'reponse_faq' => "lorem ipsum dolor sit amet",
				],
				[
				'intitule_question_faq' => "What's the real cost ?",
				'reponse_faq' => "lorem ipsum dolor sit amet",
				],
				[
				'intitule_question_faq' => "Can my company request a custom plan ?",
				'reponse_faq' => "lorem ipsum dolor sit amet",
				]
			];
		?>
		<div class="partie_haut_faq texte_blanc">
			<h3 class="titre_partie_haut_faq">Etiam laot, alique sceleris</h3>
			<p class="paragraphe_partie_haut_faq"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur.</p>
			<div class="marques_partie_haut_faq">
				<div class="maques_du_haut">
					<div class="marque marque1">
						<img src="ressources/marque1.jpg">
						<span>Kyan Boards</span>
					</div>
					<div class="marque">
						<img src="ressources/marque2.jpg">
						<span>Atica</span>
					</div>
					<div class="marque">
						<img src="ressources/marque3.jpg">
						<span>Treva</span>
					</div>
					<div class="marque">
						<img src="ressources/marque4.jpg">
						<span>Kanba</span>
					</div>
				</div>
				<div class="marques_du_bas">
					<div class="marque">
						<img src="ressources/marque5.jpg">
						<span>Tvit Forms</span>
					</div>
					<div class="marque">
						<img src="ressources/marque7.jpg">
						<span>Aven</span>
					</div>
					<div class="marque">
						<img src="ressources/marque6.jpg">
						<span>utosia</span>
					</div>
				</div>
			</div>
		</div>
		<div class="arrondi_haut_faq"></div>
		<div class="tout_faq">
			<h2>FAQ</h2>
			<p class="phrases_haut_faq">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<div class="questions_faq">
				<?php
					$ind = 0;
					foreach ($questionsFAQ as $questionFAQ) {
						echo'<a class="bouton_faq" id="bouton_faq" data-toggle="collapse" href="#reponse_faq'.$ind.'" role="button" aria-expanded="false" aria-controls="reponse_faq'.$ind.'">
							<div class="question_faq">
								<p class="titre_question_faq" >'.$questionFAQ['intitule_question_faq'].'</p>
								<div class="fleche_droite_faq">
									<i class="fas fa-caret-right icone_fleche_droite_faq"></i>
								</div>
							</div>
						</a>
						<div class="reponse_faq collapse" id="reponse_faq'.$ind.'">
							<p>'.$questionFAQ['reponse_faq'].'</p>
						</div>';
						$ind++;
					}
				?>
			</div>
			<p class="phrase_bas_faq">
				Still have unanswered questions? <a href="#" class="get_in_touch_faq"> Get in touch</a>
			</p>
		</div>
		<div class="footer_faq">
			<div class="arrondi_footer_faq"></div>
			<div class="copyright texte_blanc">
				<span>© 2019 Page protected by reCAPTCHA and subject to Google's <span class="gras">Privacy Policy</span> and <span class="gras">Terms of Service</span></span>
				<img src="ressources/links.jpg" class="reseaux">
			</div>	
		</div>
		<script type="text/javascript">
    		$(".bouton_faq").click(function(){
		 		$(".icone_fleche_droite_faq").toggleClass("fa-caret-down");
		 		$(".icone_fleche_droite_faq").toggleClass("fa-caret-right"); 
			})
		</script>
	</body>
</html>