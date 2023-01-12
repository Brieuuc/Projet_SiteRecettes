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
    <a class="admin_return_button" href="admin.php">RETOUR sur page Admin</a>
<!-- PHP Modification de recette -->
    <?php
    if (empty($_POST)){
        $Recipe = getRecipe($_GET['id']);
    }
    else{
        saveTitle($_POST['id'],$_POST['title']);
        saveIngredients($_POST['id'],$_POST['ingredients']);
        saveSteps($_POST['id'],$_POST['steps']);
        savePreptime($_POST['id'],$_POST['time']);
        $Recipe = getRecipe($_POST['id']);
        ?><p class="result_action"><?php echo "La recette d'ID = ".$_POST['id']." a été modifiée !";?></p>
        <?php
    }
    ?>
<!-- Formulaire Modification de recette -->
    <div id="modif_form"> 
        <form name="modif" method="POST">
            <p class="form_title">Modifier une recette | ID = <?php echo $Recipe['id']?></p><br>
            <label>Nom</label><br>
            <input type="text" name="title" value="<?php echo $Recipe['title']?>" placeholder="Indiquez le nom de la recette" required="required"><br>
            <label>Liste des ingrédients</label><br>
            <textarea name="ingredients" placeholder="Indiquez la liste des ingrédients" required="required"><?php echo $Recipe['ingredients']?></textarea><br>
            <label>Consignes de préparation</label><br>
            <textarea name="steps" placeholder="Indiquez les consignes de préparations" required="required"><?php echo $Recipe['steps']?></textarea><br>
            <label>Temps de préparation (en minutes)</label><br>
            <input type="number" name="time" min="0" value="<?php echo $Recipe['time']?>" placeholder="0" required="required"><br>
            <button type="submit" target="admin_modif.php?id=<?php echo $_GET['id']?>">Modifier la recette</button>
            <input name="id" type="hidden" value="<?php echo $_GET['id']?>" required="required"><br>
        </form>
    </div>
<!-- Bas de page -->
    <?php include '../html/footer.html' ?>
</body>
</html>