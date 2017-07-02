<main>
  <table>
    <tr class="head"><td>API ProcessWire</td></tr>
    <tr><td>ID</td><td>&lt;?php echo $page->id ?&gt;</td><td><?php echo $page->id ?></td></tr>
    <tr><td>Titre</td><td>&lt;?php echo $page->title ?&gt;</td><td><?php echo $page->title ?></td></tr>
    <tr><td>Template</td><td>&lt;?php echo $page->template ?&gt;</td><td><?php echo $page->template ?></td></tr>
    <tr><td>Image principale</td><td><pre>&lt;?php echo "&lt;img src='{$page->image_principale->url}' alt='{$page->image_principale->description}'&gt;" ?&gt;</pre></td><td><?php echo "<img src='{$page->image_principale->url}' alt='{$page->image_principale->description}'>" ?></td></tr>
    <tr><td>zone de texte</td><td>&lt;?php $Extra->text($page->zone_de_texte); ?&gt;</td><td><?php echo $Extra->text($page->zone_de_texte) ?></td></tr>
    <tr>
      <td>Objets de cette nature</td><td><pre>&lt;ul&gt;&lt;?php foreach($pages->find("nature=".$page->title) as $page){
        echo "&lt;li&gt;&lt;a href='$page->url'>$page->title&lt;/a&gt;&lt;/li&gt;";
      } ?&gt;&lt;/ul&gt;</pre></td>
      <td><ul><?php foreach($pages->find("nature=".$page->title) as $page){
        echo "<li><a href='$page->url'>$page->title</a></li>";
      } ?></ul></td>
  </tr>
  </table>
</main>
