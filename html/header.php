<header>
	<?php
	include_once '../libraries/librecipes.php';
	?>
	<a href="/html/search.php">SEARCH</a><br>
	<a href="/Admin/admin.php">ADMIN</a><br>
	<a href="/Admin/admin_modif.php">ADMIN MODIF</a><br>
	<a href="/html/index.php"><img class="logo" src="/images/logo.png" alt="Logo - Aux Bonnes Recettes"></a>
	<h1>Aux bonnes recettes</h1>
	<p>Trouvez plein de recettes sur cet incroyable site qui n'est en fait qu'un prototype réalisé par les bg de BTS SNIR !</p>
	<div>
		<form class="search_bar" action="/html/search.php" method="POST">
			<input type="search" name="search_bar" placeholder="Entrez une recette souhaitée">
			<button type="submit">Rechercher</button>
		</form>
	</div>
</header>
