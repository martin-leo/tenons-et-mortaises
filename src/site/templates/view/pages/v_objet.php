<main>
  <table>
    <tr class="head"><td>API ProcessWire</td></tr>

    <tr><td>ID</td><td>&lt;?php echo $page->id ?&gt;</td><td><?php echo $page->id ?></td></tr>

    <tr><td>Titre</td><td>&lt;?php echo $page->title ?&gt;</td><td><?php echo $page->title ?></td></tr>

    <tr><td>Template</td><td>&lt;?php echo $page->template ?&gt;</td><td><?php echo $page->template ?></td></tr>

    <tr><td>Nature</td><td>&lt;?php echo "&lt;a href='{$page->nature->url}'&gt;{$page->nature->title}&lt;/a&gt;" ?&gt;</td><td><?php echo "<a href='{$page->nature->url}'>{$page->nature->title}</a>" ?></td></tr>

    <tr>
      <td>objets-satellites :</td><td><pre><ul></ul></pre></td>
      <td>
        <?php if ($page->parent->template->name == "theme") {
          if ($page->children) {
            ?><ul><?php
              foreach ($page->children as $child) {
                echo "<li><a href='{$child->url}'>{$child->title}</li>";
              }
            ?></ul><?php
          }
        } else { echo "objet satellite de <a href='$page->parent->url'>{$page->parent->title}</a>"; }
        ?></td>
    </tr>

    <tr><td>date de publication TEM</td><td>&lt;?php echo date("d/m/Y",$page->date_de_publication_tem) ?&gt;</td><td><?php echo date("d/m/Y",$page->date_de_publication_tem) ?></td></tr>

    <tr><td>date de publication originale</td><td>&lt;?php echo date("d/m/Y",$page->date_de_publication_originale) ?&gt;</td><td><?php echo date("d/m/Y",$page->date_de_publication_originale) ?></td></tr>

    <tr><td>Origine</td><td>&lt;?php echo $Extra->text($page->origine) ?&gt;</td><td><?php echo $Extra->text($page->origine) ?></td></tr>

    <tr><td>Contenu</td><td>&lt;?php echo $Extra->text($page->contenu) ?&gt;</td><td><?php echo $Extra->text($page->contenu) ?></td></tr>

    <tr>
      <td>Auteurs :</td><td><pre>
        &lt;/ul&gt;
        &lt;?php
          if ($page->auteurs) {
            foreach ($page->auteurs as $auteur) {
              echo "&lt;li&gt;$auteur->auteur&lt;/li&gt;";
            }
          } else { echo "!lolz"; }
        ?&gt;
        &lt;/ul&gt;
      </pre></td>
      <td>
        <?php
          if ($page->auteurs) {
            foreach ($page->auteurs as $auteur) {
              echo "<li>$auteur->auteur</li>";
            }
          } else { echo "!lolz"; }
        ?></ul></td>
    </tr>

    <tr><td>Thèmes secondaires</td><td><pre>&lt;ul&gt;&lt;?php foreach ($page->themes_secondaires as $theme) {
      echo "&lt;li&gt;<a href='$theme->url'>&lt;?php $theme->title</a>&lt;/li&gt;";
    }; ?&gt;&lt;/ul&gt;</pre></td><td><ul><?php foreach ($page->themes_secondaires as $theme) {
      echo "<li><a href='$theme->url'>$theme->title</a></li>";
    }; ?></ul></td></tr>

    <tr><td>Objets associés</td><td><pre>&lt;ul&gt;&lt;?php foreach ($page->objets_associes as $objet) {
      echo "&lt;li&gt;<a href='$objet->url'>&lt;?php $objet->title</a>&lt;/li&gt;";
    }; ?&gt;&lt;/ul&gt;</pre></td><td><ul><?php foreach ($page->objets_associes as $objet) {
      echo "<li><a href='$objet->url'>$objet->title</a></li><br>";
    }; ?></ul></td></tr>

    <tr><td>Image principale</td><td><pre>&lt;?php echo "&lt;img src='{$page->image_principale->url}' alt='{$page->image_principale->description}'&gt;" ?&gt;</pre></td><td><?php echo "<img src='{$page->image_principale->url}' alt='{$page->image_principale->description}'>" ?></td></tr>

    <tr><td>Images</td><td><pre>&lt;?php foreach($page->images as $image) {
  echo "&lt;img src='$image->url' alt='$image->description'&gt;";
} ?&gt;</pre></td><td><?php foreach($page->images as $image) {
  echo "<img src='$image->url' alt='$image->description'>";
} ?></td></tr>

    <tr><td>zone de texte</td><td>&lt;?php $Extra->text($page->zone_de_texte); ?&gt;</td><td><?php echo $Extra->text($page->zone_de_texte) ?></td></tr>

  </table>
  <hr>
  <table>
    <tr class="head"><td>Ajouts</td></tr>
    <tr><td>Thème</td><td>$page->theme</td><td><?php echo $page->theme ?></td></tr>
    <!--
    <tr><td>$data->objets_associes</td><td><?php echo $data->objets_associes ?></td></tr>
  -->
  </table>
</main>
