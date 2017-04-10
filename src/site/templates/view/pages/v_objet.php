<main>
  /* Contenu :
    * 1. article
      * 1.1. div : conteneur non-sémantique
        * 1.1.1. header : titre, auteurs, etc.
      * 1.2. div : conteneur non-sémantique
        * 1.2.1 div : conteneur non-sémantique
          * 1.2.1.2. contenu de l'objet
        * 1.2.2. aside : objets associés, thème, etc.
          * 1.2.2.1. titre
          * 1.2.2.2. thèmes
          * 1.2.2.3. objets associés
          * 1.2.2.4. satellites
  */
  /*
      1. article : le contenu de l'objet à proprement parler
  */
  <article>
    /*
        1.1. conteneur non-sémantique
    */
    <div>
      /*
          1.1.1. header pour *l'article* : titre, auteurs, etc
      */
      <header>
        <?php $theme = get_theme($page); ?>
        <?php echo "<p>Thèmes / <a href=\"" . $theme->url . "\">" . $theme->title . "</a></p>"; ?>
        <h2><?php echo $page->title ?></h2>
        <?php $format->imprimer_auteurs($page); ?>
        <?php $format->date_tem($page); ?>
        <?php $format->imprimer_dates_et_origine($page); ?>
      </header>
    </div>
    /*
        1.2. conteneur non-sémantique
    */
    <div>
      /*
          1.2.1. contenu de l'objet
      */
      <div>
        /*
            1.1.2. contenu de l'objet
        */
        <section class="objet">
          <?php echo $Extra->text($page->contenu) ?>
        </section>
      </div>
      /*
          1.2.2 aside : objets associés, thème, etc.
          */
      <aside>
        /* titrage */
        <h2>Éléments associés</h2>
        /*
            1. thèmes
        */
        <?php $format->imprimer_themes($page); ?>
        /*
            2. objets associés
        */
        <?php $format->imprimer_objets_associes($page); ?>
        /*
            3. satellites
        */
        <?php $format->imprimer_satellites($page); ?>
      </aside>
    </div>
  </article>
  /* aside : objets associés, thèmes, projet */
</main>
