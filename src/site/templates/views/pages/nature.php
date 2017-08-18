/* <!-- main : le contenu --> */

<main id="document" class="document">

	/* <!-- en-tête du document --> */

	<header class="document__en-tete">

		/* <!-- breadcrumbs --> */

		<nav class="document__breadcrumbs">
			<h2 class="breadcrumbs__titre">breadcrumbs</h2>
			 <? echo $page->contenu->breadcrumbs; ?>
		</nav>

		<h1 class="document__titre"><?php echo $page->contenu->titre; ?></h1>

	</header>

	/* <!-- contenu : zone de texte associée au thème --> */

	<div class="document__contenu--theme">

		<?php echo $page->contenu->contenu; ?>

	</div>

	<aside class="document__aside">

		<h2 class="document__aside__titre--theme">objets associés</h2>

		<nav class="document__objets-publies">

			<h2 class="document__objets-publies">objets publiés</h2>

			<ul class="liste-d-articles--avec-iconographie">

				<?php foreach ( array_reverse ( $page->contenu->objets ) as $objet) { echo $objet; } ?>

			</ul>

		</nav>

	</aside>

</main>
