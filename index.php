
<?php
	include('question-incl.php');
	


	$errorTab = array(
					'nom' => "Tu as oublié ton nom",
					'prenom' => "Tu as oublié ton prénom" , 
					'email' => "Tu as oublié ton e-mail" ,
					'validemail' =>"Ton email n'est pas valide",
					'dateDeNaissance' => "Tu as oublié ta date de naissance",
					);

	$error = array();

	$mois = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

	 

	function assignation($argument){
		$argument = strip_tags(trim($argument));
		return $argument;
	};

	function valid_email($email){
		return filter_var($email, FILTER_VALIDATE_EMAIL);
	};

	function erreurAffichage($argument){
		if (strlen($argument) > 0) {
    			echo "class='error'";
    	}
	}


	$honey = assignation($_POST["honey"]);
	

	$min_year = 1990;
    $max_year = date("Y");

	$nom = assignation($_POST["nom"]);
	$prenom = assignation($_POST["prenom"]);
	$questions = assignation($_POST["questions"]);
	$email = assignation($_POST["email"]);

	$day = assignation($_POST["day"]);
	$month = assignation($_POST["month"]);
	$annee = assignation($_POST["annee"]);



	$monmail = 'shervin2502@gmail.com';
	$sujet = 'email du ceaj';
	$resulatform = $nom." ".$prenom." ".$email." ".$day."/".$month."/".$annee."/".$questions;

	if (strlen($honey) > 0) {
		die("die");
	}else{
		if(count($_POST) > 0){
			if (strlen($nom) == 0) {
				$error["nom"] = $errorTab["nom"];
				if(strlen($prenom) == 0){
					$error["prenom"] = $errorTab["prenom"];
					
				} 
				if(strlen($email) == 0){
					$error["email"] = $errorTab["email"];
					
				}else if(valid_email($email) == false){
					$error["email"] = $errorTab["validemail"];
					echo "ton adresse e-mail est invalide";
				}
				if ($day == "-") {
					$error["dateDeNaissance"] = $errorTab["dateDeNaissance"];
				}
				if ($mois == "-") {
					$error["dateDeNaissance"] = $errorTab["dateDeNaissance"];
				}
				if ($annee == "-") {
					$error["dateDeNaissance"] = $errorTab["dateDeNaissance"];
				}
			}
		}
	}




	
	

	
	
?>







<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php include('og-incl.php') ?>
        <title>CEAJ - Inscriptions</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="author" href="humans.txt">
    </head>
    <body>
    	<div class="logo">
    		<img class="logo-un" src="img/ceaj.svg">
    		<img class="logo-un" src="img/ceaj-deux.svg">
    		
    		<h1>Page de recrutement du cercle des étudiants de l’ ESIAJ</h1>
    	</div>
    	<p>Il ne te reste plus que quelques petites étapes pour devenir membre officiel du ceaj.</p>
    	<p>Mais pourquoi devenir membre ? </p>
    	<p>Le fait de devenir membre te permettra de mener à bien les projets proposés par les étudiants. Tu seras la relation entre les élèves et la direction de l'école.</p>
    	<?php 

    		if (count($_POST) > 0) {
    			if (count($error) == 0) {
    				$resultat = mail($monmail,$sujet,$resulatform);
    				if ($resultat) {
    					echo "<h1 class='bonjour'>Merci votre mail a bien été envoyé ! </h1>";
    				}
    			}
    		}
		?>
    	<form method=post>
    		<input id="honey" placeholder="honey" name="honey">

    		<label for="nom" id="mar" <?php erreurAffichage($error["nom"]); ?> >Votre nom</label>
    		<input id="nom" placeholder="Van Houtten" name="nom">


    		<label for="prenom" <?php erreurAffichage($error["prenom"]); ?> >Votre prénom</label>
    		<input id="prenom" placeholder="Jean" name="prenom">

    		<label for="email" <?php erreurAffichage($error["email"]); ?> >Votre e-mail</label>
    		<input id="email" placeholder="exemple@gmail.com" name="email">
    		<fieldset class="naissance">
	    		<legend for="day" <?php erreurAffichage($error["dateDeNaissance"]); ?> >Votre date de naissance</legend>


				<select id="day" name="day">
					<option value="-" >-</option>
					<?php
					for($i = 1; $i <= 31; $i++) {	
    						echo '<option value="'.$i.'" >'.$i.'</option> ';
						}
					?>
				</select>



				<select id="month" name="month">
					<option value="-" >-</option>
					<?php
					foreach($mois as $value){
    						echo '<option value="'.$value.'" >'.$value.'</option> ';
    					}
    				?>
				</select>
				<select id="yearBuiltMax" name="annee">
					<option value="-" >-</option>
	      			<?php 

	        			foreach (range($max_year, $min_year) as $year) { ?>
	        			<option value="<?php echo($year); ?>"><?php echo($year); ?></option>
	        		<?php } ?>
				</select>


			</fieldset>
			<label for="adresse">Votre adresse</label>
			<textarea id="adresse" name="adresse" placeholder="rue de l'aumônier, 23 Liège"></textarea>
			<div class="questionnement">
				<label for="question">Pourquoi veux tu rejoindre le cercle? </label>
				<select id="question" name="questions">
					<?php foreach ($question as $key => $value){
							echo "<option value'".$key."'>".$value."</option>";
						} 
					?>
						

				</select>
			</div>

			<input type="submit" id="submit" name="submit" value="Envoyer">

    	</form>
        
    </body>
</html>