<main>
  <table>
    <tr class="head"><td>API ProcessWire</td></tr>
    <tr><td>ID</td><td>&lt;?php echo $page->id ?&gt;</td><td><?php echo $page->id ?></td></tr>
    <tr><td>Titre</td><td>&lt;?php echo $page->title ?&gt;</td><td><?php echo $page->title ?></td></tr>
    <tr><td>Template</td><td>&lt;?php echo $page->template ?&gt;</td><td><?php echo $page->template ?></td></tr>
    <tr><td>date de publication TEM</td><td>&lt;?php echo $page->date_de_publication_tem ?&gt;</td><td><?php echo $page->date_de_publication_tem ?></td></tr>
    <tr><td>Contenu</td><td>&lt;?php echo $Extra->text($page->contenu) ?&gt;</td><td><?php echo $Extra->text($page->contenu) ?></td></tr>
    <tr><td>Thèmes secondaires</td><td><pre>&lt;ul&gt;&lt;?php foreach ($page->themes_secondaires as $theme) {
      echo "&lt;li&gt;<a href='$theme->url'>&lt;?php $theme->title</a>&lt;/li&gt;";
    }; ?&gt;&lt;/ul&gt;</pre></td><td><?php foreach ($page->themes_secondaires as $theme) {
      echo "<a href='$theme->url'>$theme->title</a><br>";
    }; ?></td></tr>
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
