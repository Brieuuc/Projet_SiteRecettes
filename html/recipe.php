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
<!-- PHP Ajout Commentaire -->
    <?php
    if (!empty($_POST)){
        if (hasAlreadyRated($_POST['id'], $_SERVER['REMOTE_ADDR'])){
            echo "Erreur : Vous avez déjà émis un avis sur cette recette !";
        }
        else{
        rateRecipe($_POST['id'], $_SERVER['REMOTE_ADDR'], $_POST['note'], $_POST['comment']);
        echo "Votre avis a été publié !";
        }
    }
    ?>
<!-- PHP Récupération détails recette -->
    <?php 
    $Recipe = getRecipe($_GET['id']);
    $Note = moyenneNote($Recipe);
    if ($Note == -1){
        $NoteFinale = 'Aucune';
    }
    else{
        $NoteFinale = $Note.'/5';
    }
    ?>
<!-- Affichage Recette -->
    <div class="recette">
        <h2><?php echo $Recipe['title'];?></h2>
        <!-- Affichage Note / Temps de préparation SI AUCUN AVIS-->
        <?php
        $RecipeComments = getRecipeComments($_GET['id']);
        echo "<div>Note des internautes : ".$NoteFinale." (".count($RecipeComments)." avis)  -  <img src='../images/hourglass.png' class='logo_manage' title='Temps' alt='Temps'>".$Recipe['time']." minutes</div>";
        ?>
        <!-- Affichage Ingrédients / Consignes de préparation -->
        <h3>Ingrédients</h3>
        <p class='affichage_recette'><?php echo $Recipe['ingredients'];?></p>
        <h3>Etapes</h3>
        <p class='affichage_recette'><?php echo $Recipe['steps'];?></p>
    </div>
<!-- Section Commentaire -->
    <hr><h3>SECTION COMMENTAIRE</h3>
    <!-- Formulaire Commentaire -->
    <div class="comments_form">
        <p>Mettre un commentaire :</p>
        <form method="POST">
            <input name="comment" type="text" placeholder="Entrez votre commentaire" required="required">
            <select name="note">
                <option value="">Choisissez une note</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit" target="recipe.php?id=<?php echo $_GET['id']?>">Mettre l'avis</button>
            <input name="id" type="hidden" value="<?php echo $_GET['id']?>" required="required"><br>
        </form>
    </div>
    <hr>
    <!-- Affichage Commentaire(s) -->
    <div class="comments_list">
    <?php
        if (empty(getRecipeComments($_GET['id']))){
            echo "<p>Aucun avis sur cette recette. Soyez le premier à en mettre un via le formulaire ci-dessus !</p>";
        }
        else{
            foreach ($RecipeComments as $Comment){
                echo "<div class='comment'>Note : ".$Comment['note']."<br>Commentaire : ".$Comment['comment']."</div>";
            }
        }
    ?>
    </div>
	<?php include 'footer.html' ?>
</body>
</html>