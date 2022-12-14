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
		echo "<p>Bienvenue sur notre site. Vous y trouverez une multitude de recettes.<br>Malheuresement il n'y a pour le moment aucune recette référencé...<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
	}
// Accueil si 1 recette sans commentaire
	else{
		$AllRecipes = getAllRecipes();
		$first = true;
		foreach ($AllRecipes as $RecipeId){
			if ($first){
				$RecipeIdNote = $RecipeId['id'];
				$RecipeIdLast = $RecipeId['id'];
				$RecipeIdTime = $RecipeId['id'];
				$first = false;
			}
			else{
				if(getRecipe($RecipeIdNote)['time'] > getRecipe($RecipeId)['time']){
					$RecipeIdNote = $Recipe;
				} 
			}

		}
		if (count($AllRecipes) == 1){
			echo "<p>Bienvenue sur notre site. Vous y trouverez une multitude de recettes.<br>A ce jour notre site ne comporte qu'une seule recette...<br>";
			foreach ($AllRecipes as $Recipe){
			};
			$RecipeComments = getRecipeComments($Recipe['id']);
			if (empty(getRecipeComments($Recipe['id']))){
				echo "
				<div>
					<h2>Notre unique recette</h2>
					<h3>".$Recipe['title']."<h3>
					<p>Note : Aucune - Temps de préparation : ".$Recipe['time']."</p>
				</div>
				";
			}
// Accueil si 1 recette avec commentaire(s)
			else{
				foreach ($RecipeComments as $Note){
					$Notes = $Notes + $Note['note'];
				};
				foreach ($RecipeComments as $Note){
					$Notes = $Notes + $Note['note'];
				};
				echo "
				<div>
					<h2>Notre unique recette</h2>
					<h3>".$Recipe['title']."<h3>
					<p>Note : ".$Note['note']."/5 - Temps de préparation : ".$Recipe['time']." minutes</p>
				</div>
				";
			}
		}
// Accueil si plusieurs recettes
		else{
			echo "<p>Bienvenue sur notre site. Vous y trouverez une multitude de recettes.<br>A ce jour notre site comporte ".count($AllRecipes)." recettes.<br>";
			echo "
			<div>
				<h2>Notre dernière recette</h2>
				<h3>".$Recipe['title']."<h3>
				<p>Note : ".$Note['note']."/5 - Temps de préparation : ".$Recipe['time']." minutes</p>
			</div>";

			echo "
			<div>
				<h2>Recette la mieux notée</h2>
			</div>";
			$Recipe = getRecipe($RecipeIdTime);
			echo "
			<div>
				<h2>Recette la plus rapide</h2>
				<h3>".$Recipe['title']."<h3>
				<p>Note : ".$Note['note']."/5 - Temps de préparation : ".$Recipe['time']." minutes</p>
			</div>
			";
		}
	}
	?>
	<?php include 'footer.html' ?>
</body>
</html>