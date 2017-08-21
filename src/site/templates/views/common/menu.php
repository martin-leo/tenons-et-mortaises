/* <!-- nav : menu --> */
<nav id="menu" class="menu">

	<header class="menu__en-tete">
		<h2 class="menu__titre">navigation</h2>

		<button id="menu__bouton-menu" class="menu__bouton--ouvrir-menu" type="button" name="ouvrir-menu">☰</button>
		<button id="menu__bouton-carte" class="menu__bouton--afficher-carte" type="button" name="afficher-carte" data-pictogramme--off="T">∵</button>

	</header>

	<ul class="menu__liste"><?php echo $page->menu; ?></ul>

</nav>
