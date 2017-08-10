/* <!-- main : le contenu --> */

<main id="document" class="document">

	/* <!-- en-tête du document --> */

	<header class="document__en-tete">

		/* <!-- breadcrumbs --> */

		<nav class="document__breadcrumbs">
			<h2 class="breadcrumbs__titre">breadcrumbs</h2>
			 <? echo $page->objet->breadcrumbs; ?>
		</nav>

		/* <!-- titre du document --> */

		<h1 class="document__titre"><?php echo $page->objet->titre; ?></h1>

		/* <!-- date(s) --> */

		<?php if ( $page->objet->dates ) { ?>
		<p class="document__date"><?php echo $page->objet->dates; ?></p>
		<?php } ?>

	</header>

	/* <!-- contenu du document --> */

  /* <!-- contenu (markdown) --> */

	<div class="document__contenu--article"><?php echo $page->objet->contenu; ?></div>

  /* <!-- carte --> */

  <aside class="document__carte">
    <h2 class="document__carte__titre">Lieu<?php if ( $page->objet->lieux->count() > 1 ) { echo "x"; } ?></h3>
    <?php echo $page->objet->carte->render($page->objet->lieux, 'localisation'); ?>
  </aside>

  /* <!-- sous-événements (si applicable) --> */

	<?php if ( sizeof( $page->objet->sous_evenements ) > 0 ) { ?>
	<nav class="document__objets-associes">

		<h2 class="document__objets-associes__titre">Programmation</h2>

		<ul class="liste-d-articles--avec-iconographie">
			<?php foreach ( $page->objet->sous_evenements as $sous_evenements ) { echo $sous_evenements; } ?>
		</ul>

	</nav>
	<?php } ?>

  /* <!-- objets associés --> */

	<?php if ( sizeof( $page->objet->objets_associes ) > 0 ) { ?>
	<nav class="document__objets-associes">

		<h2 class="document__objets-associes__titre">objets associés</h2>

		<ul class="liste-d-articles--avec-iconographie">
			<?php foreach ( $page->objet->objets_associes as $objet_associe ) { echo $objet_associe; } ?>
		</ul>

	</nav>
	<?php } ?>

</main>
