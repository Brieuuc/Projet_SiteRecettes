<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Aux bonnes recettes - Modifier recette</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link rel="icon" type="image/x-icon" href="../images/logo.png">
</head>
<body>
	<?php include 'header.html' ?>
    <p>Page Administration - Modifier recette</p>
    <div id="modif_form"> 
        <form name="create" method="_POST">
            <p class="form_title">Créer une recette</p><br>
            <label>Nom</label><br>
            <input type="text" placeholder="Indiquez le nom de la recette" required="required"><br>
            <label>Liste des ingrédients</label><br>
            <textarea required="required" placeholder="Indiquez la liste des ingrédients"></textarea><br>
            <label>Consignes de préparation</label><br>
            <textarea required="required" placeholder="Indiquez les consignes de préparations"></textarea><br>
            <label>Temps de préparation (en minutes)</label><br>
            <input type="number" required="required" placeholder="0"><br>
            <button type="submit">Créer la recette</button>
        </form>
    </div>
    <?php include 'footer.html' ?>
</body>
</html>