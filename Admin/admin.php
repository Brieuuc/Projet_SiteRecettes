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
	<?php include '../html/header.php'?>
<!-- PHP création d'une recette -->
    <?php
    if  (!empty($_POST['nom'])){
        $idRecipe = createRecipe($_POST['nom']);
        saveIngredients($idRecipe,$_POST['ingredients']);
        saveSteps($idRecipe,$_POST['steps']);
        savePreptime($idRecipe,$_POST['time']);
        echo('La recette a été créée !');
    }
    ?>
<!-- Formulaire création d'une recette -->
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
<!-- Affichage des recettes -->
        <div id="recipes_list">
            <p>Liste des recettes</p></br>
            <?php
            $allRecipes = getAllRecipes();
            foreach ($allRecipes as $Recipe){?>
                <div>
                    <?php echo "ID : ".$Recipe['id']?></br>
                    <?php echo "Nom : ".$Recipe['name']?></br>
                </div>
                
            <?php}
            ?>
        </div>
    </div>
<!-- Bas de page -->
    <?php include '../html/footer.html' ?>
</body>
</html>
