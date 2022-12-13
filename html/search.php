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
	<p>Page recherche</p>

	<?php if (empty($_POST['search_bar'])){ ?>
		<p>Veuillez indiquer une recette dans la recherche ci-dessus.</p>
	<?php } else { ?>
		<p>Votre résultat pour : <?php echo $_POST['search_bar']; ?></p>
	<?php } ?>
	<?php include 'footer.html' ?>
</body>
</html>