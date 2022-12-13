<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Aux bonnes recettes</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="icon" type="image/x-icon" href="/images/logo.png">
</head>
<body>
	<?php include '../html/header.php'?>

    <?php
    if  (!empty($_POST['nom'])){
        $idRecipe = createRecipe($_POST['nom']);
        saveIngredients($idRecipe,$_POST['ingredients']);
        saveSteps($idRecipe,$_POST['steps']);
        savePreptime($idRecipe,$_POST['time']);
        echo('La recette a été créée !');
    }
    ?>

    <div class="admin_forms">
        <div id="create_form">
            <form class="create" action="/Admin/admin.php" method="POST">
                <p class="form_title">Créer une recette</p><br>
                <label>Nom</label><br>
                <input name="nom" type="text" placeholder="Indiquez le nom de la recette" required="required"><br>
                <label>Liste des ingrédients</label><br>
                <textarea name="ingredients" required="required" placeholder="Indiquez la liste des ingrédients"></textarea><br>
                <label>Consignes de préparation</label><br>
                <textarea name="steps" required="required" placeholder="Indiquez les consignes de préparations"></textarea><br>
                <label>Temps de préparation (en minutes)</label><br>
                <input name="time" type="number" required="required" placeholder="0"><br>
                <button type="submit">Créer la recette</button>
            </form>
        </div>
        <div id="recipes_list">

        </div>
    </div>
    <?php include '../html/footer.html' ?>
</body>
</html>
