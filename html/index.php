<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Aux bonnes recettes</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="icon" type="image/x-icon" href="/images/logo.png">
</head>
<body>
<!-- En-tête de la page -->
	<?php include 'header.php' ?>
<!-- Accueil si aucune recette -->
	<?php if (empty(getAllRecipes())){
		echo "<p>Bienvenue sur notre site. Vous y trouverez une multitude de recettes.<br>Malheuresement il n'y a pour le moment aucune recette référencée...<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
	}
	else{
		$AllRecipes = getAllRecipes();
		if (count($AllRecipes) == 1){
			echo "<p>Bienvenue sur notre site. Vous y trouverez une multitude de recettes.<br>A ce jour notre site ne comporte qu'une seule recette...<br>";
			foreach ($AllRecipes as $Recipe){
			}
			$RecipeComments = getRecipeComments($Recipe['id']);
			if (empty(getRecipeComments($Recipe['id']))){
				echo "
				<div>
					<h2>Notre unique recette</h2>
					<h3>".$Recipe['title']."<h3>
					<p>Note : Aucune - Temps de préparation : ".$Recipe['time']."</p>
					<a href='recipe?id=".$Recipe['id']."'>Voir la recette</a>
				</div>
				";
			}
		}
// Accueil si plusieurs recettes
		else{
			$first = true;
			foreach ($AllRecipes as $Recipe){
				if ($first){
					$RecipeNote = $Recipe;
					$RecipeTime = $Recipe;
					$first = false;
				}
				else{
					if($RecipeTime['time'] > $Recipe['time']){
						$RecipeTime = $Recipe;
					}
					if (moyenneNote($RecipeNote) <  moyenneNote($Recipe)){
						$RecipeNote = $Recipe;
					}
				}
			}
// Affichage de la recette la dernière recette
			$RecipeLast = end($AllRecipes);
			$Note = moyenneNote($RecipeLast);
			if ($Note == -1){
				$NoteFinale = 'Aucun Avis';
			}
			else{
				$NoteFinale = $Note.'/5';
			}
			echo "<p>Bienvenue sur notre site. Vous y trouverez une multitude de recettes.<br>A ce jour notre site comporte ".count($AllRecipes)." recettes.<br>";
			echo "
			<div>
				<h2>Notre dernière recette</h2>
				<h3>".$RecipeLast['title']."</h3>
				<p>Note : ".$NoteFinale." - Temps de préparation : ".$RecipeLast['time']." minutes</p>
				<a href='recipe?id=".$RecipeLast['id']."'>Voir la recette</a>
			</div>";
// Affichage de la recette la mieux notée
			$Note = moyenneNote($RecipeNote);
			if ($Note > -1){
				echo "
				<div>
					<h2>Recette la mieux notée</h2>
					<h3>".$RecipeNote['title']."</h3>
					<p>Note : ".$Note."/5 - Temps de préparation : ".$RecipeNote['time']." minutes</p>
					<a href='recipe?id=".$RecipeNote['id']."'>Voir la recette</a>
				</div>";
			}

// Affichage de la recette la plus rapide
			$Note = moyenneNote($RecipeTime);
			if ($Note == -1){
				$NoteFinale = 'Aucun Avis';
			}
			else{
				$NoteFinale = $Note.'/5';
			}
			echo "
			<div>
				<h2>Recette la plus rapide</h2>
				<h3>".$RecipeTime['title']."</h3>
				<p>Note : ".$NoteFinale." - Temps de préparation : ".$RecipeTime['time']." minutes</p>
				<a href='recipe?id=".$RecipeTime['id']."'>Voir la recette</a>
			</div>";
		}
	}
	?>
	<?php include 'footer.html' ?>
</body>
</html>