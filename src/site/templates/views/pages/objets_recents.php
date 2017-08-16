/* <!-- main : le contenu --> */

<main id="document" class="document">

	/* <!-- en-tête du document --> */

	<header class="document__en-tete">

		/* <!-- breadcrumbs --> */

		<nav class="document__breadcrumbs">
			<h2 class="breadcrumbs__titre">breadcrumbs</h2>
			 <? echo $page->contenu->breadcrumbs; ?>
		</nav>

		/* <!-- titre du document --> */

		<h1 class="document__titre"><?php echo $page->title; ?></h1>

	</header>

	/* <!-- contenu du document --> */

	<div class="document__contenu">

			<nav class="objets-recents">
				<h2 class="objets-recents__titre">liste des objets récents</h2>

				<ul class="liste-d-articles--avec-iconographie">

					<?php echo $page->contenu; ?>

				</ul>

			</nav>

		</div>


</main>
