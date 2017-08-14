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

	/* <!-- éléments associés --> */

	<aside class="document__aside">

		<h2 class="document__aside__titre--theme">objets associés</h2>

		<nav class="objets-recents">

			<h2 class="objets-recents__titre--theme">Dans cette thématique&nbsp;:</h2>

			<ul class="liste-d-articles">

				<?php foreach ($page->contenu->descendants as $descendant) { ?>

					<li class="liste-d-articles__item">
						<section class="article-liste">
							<h3 class="article-liste__titre"><a href="<?php echo $descendant->url; ?>"><?php echo $descendant->nom; ?></a></h3>
							<p class="article-liste__date-de-parution"><?php echo $descendant->dates; ?></p>
						</section>
					</li>

				<?php } ?>

			</ul>

		</nav>

	</aside>

</main>
