<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Aux bonnes recettes</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="icon" type="image/x-icon" href="/images/logo.png">
</head>
<body>
	<?php include 'header.php';
	// Si on est sur la page et qu'il n'y aucune de données de recherche envoyées
	if (empty($_POST['search'])){
		echo "<p>Veuillez indiquer une recette ou un ingrédient dans la recherche ci-dessus.</p>";
	}
	// Sinon si on a des données de recherche
	else{
		// Récupère les résultats correspondants aux deux types de recherche et les fusionnent
		$searchTitle = searchRecipesByTitle($_POST['search']);
		$searchIngredients = searchRecipesByIngredient($_POST['search']);
		$searchResults = array_merge($searchTitle,$searchIngredients);
		// Recherche les éventuels doublons
		$tailleResults = count($searchResults);
		$doublonList = [];
		for($i=0; $i<$tailleResults-1; $i++){
			$firstId = $searchResults[$i]['id'];
			for($j = ($i + 1); $j<$tailleResults; $j++){
				$secondId = $searchResults[$j]['id'];
				if($firstId == $secondId){
					array_unshift($doublonList,$j);
				}
			}
		}
		// Supprime les doublons
		foreach($doublonList as $doublon){
			unset($searchResults[$doublon]);
		}
		// Si aucun résultat
		if (empty($searchResults)){
			
			echo "<p>Aucun résultat trouvé !";
		}
		// Affichage des résultats
		else{
			echo "<div class=result_list>";
			echo "<p class=search_title>Recherche : ".$_POST['search']." - Nombre de résultat : ".count($searchResults)."</p>";
			$pas = 0;
			foreach($searchResults as $Recipe){
				$Note = moyenneNote($Recipe);
				if ($Note == -1){
					$Note = 'Aucun Avis';
				}
				else{
					$Note = $Note.'/5';
				}
				echo "
				<div class='search_recette_".($pas%2)."'>
					<h3>".$Recipe['title']."</h3>
					<p>Note : ".$Note." - Temps de préparation : ".$Recipe['time']." minutes</p>
					<a href='recipe.php?id=".$Recipe['id']."'>Voir la recette</a>
				</div>";
				$pas++;
			}
			echo "</div>";
		}
	}
	?>
	<?php include 'footer.html' ?>
</body>
</html>