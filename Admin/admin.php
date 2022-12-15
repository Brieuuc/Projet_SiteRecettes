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
        ?><p class="result_action"><?php echo('La recette "'.$_POST['nom'].'" (ID = '.$idRecipe.') a été créée !');?></p><?php
    }
    ?>
<!-- PHP Supression de recette -->
    <?php
        if  (!empty($_GET['id'])){
            $RecipeName = getRecipe($_GET['id'])['title'];
            deleteRecipe($_GET['id']);
            ?><p class="result_action"><?php echo('La recette "'.$RecipeName.'" (ID = '.$_GET['id'].') a été supprimée !');?></p><?php
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
            <p class="form_title">Liste des recettes</p></br>
            <div class="recipes_display">
            <?php
            $allRecipes = getAllRecipes();
            if (!empty($allRecipes)){
                foreach ($allRecipes as $Recipe){?>
                    <div class="admin_recette">
                        <p>ID : <?php echo $Recipe['id']?></br>
                        Nom : <?php echo $Recipe['title']?></p>
                        <a href="../html/recipe.php?id=<?php echo $Recipe['id']?>" title="Voir la recette"><img src="../images/eye.png" class="logo_manage" alt="Voir"></img></a>
                        <a href="admin_modif.php?id=<?php echo $Recipe['id']?>" title="Modifier la recette"><img src="../images/modify.png" class="logo_manage" alt="Modifier"></img></a>
                        <a href="admin.php?id=<?php echo $Recipe['id']?>" title="Supprimer la recette"><img src="../images/delete.png" class="logo_manage" alt="Supprimer"></img></a>
                    </div><?php
                }
            }
            else{
                echo "Aucune recette n'est créée.";
            }
            ?>
            </div>
        </div>
    </div>
<!-- Bas de page -->
    <?php include '../html/footer.html' ?>
</body>
</html>
