/* <!-- main : le contenu --> */

<main id="document" class="document">

	/* <!-- en-tête du document --> */

	<header class="document__en-tete">

		/* <!-- breadcrumbs --> */

		<nav class="document__breadcrumbs">
			<h2 class="breadcrumbs__titre">breadcrumbs</h2>
			 <? echo  $page->contenu->breadcrumbs; ?>
		</nav>

		<h1 class="document__titre"><?php echo $page->title; ?></h1>

	</header>

  <div class="document__contenu">

  		<nav class="themes">
  			<h2 class="themes__titre">liste des thèmes</h2>
  			<ul class="themes__liste">
  				<?php echo $page->contenu; ?>
  			</ul>
  		</nav>

  	</div>

</main>
