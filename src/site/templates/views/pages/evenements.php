/* <!-- main : le contenu --> */

<main id="document" class="document">

	/* <!-- en-tête du document --> */

	<header class="document__en-tete">

		/* <!-- breadcrumbs --> */

		<nav class="document__breadcrumbs">
			<h2 class="breadcrumbs__titre">breadcrumbs</h2>
			 <? echo $page->evenements->breadcrumbs; ?>
		</nav>

		/* <!-- titre du document --> */

		<h1 class="document__titre"><?php echo $page->title; ?></h1>

	</header>

	<div class="document__contenu"><?php echo $page->zone_de_texte; ?></div>

	/* <!-- contenu du document --> */

  <?php if ( count ($page->evenements->presents ) > 0) { ?>

  <nav class="document__objets-associes">

		<h2 class="document__objets-associes__titre">En ce moment</h2>

		<ul class="liste-d-articles--avec-iconographie">
			<?php foreach ( $page->evenements->presents as $evenement ) { echo $evenement; } ?>
		</ul>

	</nav>

  <?php } ?>

  <?php if ( count ($page->evenements->futurs ) > 0) { ?>

  <nav class="document__objets-associes">

		<h2 class="document__objets-associes__titre">Futurs</h2>

		<ul class="liste-d-articles--avec-iconographie">
			<?php foreach ( $page->evenements->futurs as $evenement ) { echo $evenement; } ?>
		</ul>

	</nav>

  <?php } ?>

  <nav class="document__objets-associes">

		<h2 class="document__objets-associes__titre">Passés</h2>

		<ul class="liste-d-articles--avec-iconographie">
			<?php foreach ( $page->evenements->passes as $evenement ) { echo $evenement; } ?>
		</ul>

	</nav>

</main>
