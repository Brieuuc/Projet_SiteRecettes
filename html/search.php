<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Aux bonnes recettes</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="icon" type="image/x-icon" href="/images/logo.png">
</head>
<body>
	<?php include 'header.php'?>
	<?php
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
	?>
	<p>Page recherche</p>

	<?php if (empty($_POST['search'])){
		echo "<p>Veuillez indiquer une recette dans la recherche ci-dessus.</p>";
	}
	else{
		if (empty($searchResults)){
			echo "<p>Aucun résultat trouvé !";
		}
		else{
			echo "<p>Résultats trouvés : ".count($searchResults)."</p>";

		}
	} ?>
	<?php include 'footer.html' ?>
</body>
</html>