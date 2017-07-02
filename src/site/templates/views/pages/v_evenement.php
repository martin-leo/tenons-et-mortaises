<main>
  <table>
    <tr class="head"><td>API ProcessWire</td></tr>
    <tr><td>ID</td><td>&lt;?php echo $page->id ?&gt;</td><td><?php echo $page->id ?></td></tr>
    <tr><td>Titre</td><td>&lt;?php echo $page->title ?&gt;</td><td><?php echo $page->title ?></td></tr>
    <tr><td>Template</td><td>&lt;?php echo $page->template ?&gt;</td><td><?php echo $page->template ?></td></tr><tr><td>Événément Parent ?</td><td><pre>&lt;?php if ($page->parent->template->name == "evenement") { echo "&lt;a href='$page->parent->url'&gt;$page->parent->title&lt;/a&gt;"; } else { echo "✖"; }; ?&gt;</pre></td><td><?php if ($page->parent->template->name == "evenement") { echo "<a href='$page->parent->url'>{$page->parent->title}</a>"; } else { echo "✖"; }; ?></td></tr>
    <tr><td>Sous-événements :</td><td><pre><ul>&lt;?php foreach($page->children as $child) {
      echo "&lt;li?&gt;&lt;a href='$child->url'>$child->title&lt;/a?&gt;&lt;/li?&gt;";
      if (!$child->children == null) {
        ?&gt;&lt;ul?&gt;&lt;?php
        foreach ($child->children as $grandchild) {
          echo "&lt;li?&gt;&lt;a href='$grandchild->url'>$grandchild->title&lt;/a?&gt;&lt;/li?&gt;";
        }
        ?&gt;&lt;/ul?&gt;&lt;?php
      }
} ?&gt;</ul></pre></td><td><?php foreach($page->children as $child) {
      echo "<li?><a href='$child->url'>$child->title</a?></li?>";
      if (!$child->children == null) {
        ?><ul?><?php
        foreach ($child->children as $grandchild) {
          echo "<li?><a href='$grandchild->url'>$grandchild->title</a?></li?>";
        }
        ?></ul?><?php
      }
} ?></td></tr>
    <tr><td>date de publication TEM</td><td>&lt;?php echo date("d/m/Y",$page->date_de_publication_tem) ?&gt;</td><td><?php echo date("d/m/Y",$page->date_de_publication_tem) ?></td></tr>
    <tr><td>date de début</td><td>&lt;?php echo date("d/m/Y",$page->date_de_debut) ?&gt;</td><td><?php echo date("d/m/Y",$page->date_de_debut) ?></td></tr>
    <tr><td>date de fin</td><td>&lt;?php echo date("d/m/Y",$page->date_de_fin) ?&gt;</td><td><?php echo date("d/m/Y",$page->date_de_fin) ?></td></tr>
    <tr><td>localisations</td><td><pre>
      &lt;?php
      $map = $modules->get('MarkupGoogleMap');
      if ($page->children) {
        $items = $page->children;
        $items->push($page);
      } else { $items = $page; }
      echo $map->render($items, 'localisation');
       ?&gt;</pre></td><td>
      <?php
      $map = $modules->get('MarkupGoogleMap');
      if ($page->children) {
        $items = $page->children;
        $items->push($page);
      } else { $items = $page; }
      echo $map->render($items, 'localisation');
       ?>
    </td></tr>
    <tr><td>Contenu</td><td>&lt;?php echo $Extra->text($page->contenu) ?&gt;</td><td><?php echo $Extra->text($page->contenu) ?></td></tr>
    <td><ul><?php foreach($page->children as $child) {
      echo "<li><a href='$child->url'>$child->title</a></li>";
      if (!$child->children == null) {
        ?><ul><?php
        foreach ($child->children as $grandchild) {
          echo "<li><a href='$grandchild->url'>$grandchild->title</a></li>";
        }
        ?></ul><?php
      }
} ?></ul></td></tr>
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
