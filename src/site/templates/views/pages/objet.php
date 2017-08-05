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

		/* <!-- auteurs (opt.) --> */

		<?php if ( $page->objet->auteurs->specifies() ) { ?>
		<p class="document__auteurs"><?php echo $page->objet->auteurs; ?></p>
		<?php } ?>

	</header>

	/* <!-- contenu du document --> */

	<div class="document__contenu--article"><?php echo $page->objet->contenu; ?></div>

	/* <!-- pied de page du document --> */

	<footer class="document__pied-de-page">
		<h2 class="pied-de-page__titre">pied de page</h2>
		<p class="document__parution">Paru <?php echo $page->objet->date_de_publication; if ( $page->objet->origine != "") { echo ", "; echo $page->objet->origine; } ?></p>
	</footer>

	/* <!-- document associés --> */

	/* <!-- satellites --> */
	<?php if ( sizeof( $page->objet->satellites ) > 0 ) { ?>
	<nav class="document__objets-satellites">

		<h2 class="document__objets-satellites">satellites</h2>

		<ul class="liste-d-articles--avec-iconographie">
			<?php foreach ( $page->objet->satellites as $satellite) { echo $satellite; } ?>
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
