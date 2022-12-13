<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Aux bonnes recettes - Modifier recette</title>
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="icon" type="image/x-icon" href="/images/logo.png">
    <link >
</head>
<body>
	<?php include '../html/header.php'?>
    <div id="modif_form"> 
        <!--?php $recipe = getRecipe($id) ?-->
        <form name="modif" method="_POST">
            <p class="form_title">Modifier une recette</p><br>
            <label>Nom</label><br>
            <input type="text" value="<?php echo $recipe['title']?>" placeholder="Indiquez le nom de la recette" required="required"><br>
            <label>Liste des ingrédients</label><br>
            <textarea required="required" value="<?php echo $recipe['ingredients']?>" placeholder="Indiquez la liste des ingrédients"></textarea><br>
            <label>Consignes de préparation</label><br>
            <textarea required="required" value="<?php echo $recipe['steps']?>" placeholder="Indiquez les consignes de préparations"></textarea><br>
            <label>Temps de préparation (en minutes)</label><br>
            <input type="number" value="<?php echo $recipe['time']?>" required="required" placeholder="0"><br>
            <button type="submit">Modifier la recette</button>
        </form>
    </div>
    <?php include '../html/footer.html' ?>
</body>
</html>