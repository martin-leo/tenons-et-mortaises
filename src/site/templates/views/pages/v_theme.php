<main>
  <table>
    <tr class="head"><td>API ProcessWire</td></tr>
    <tr><td>ID</td><td>&lt;?php echo $page->id ?&gt;</td><td><?php echo $page->id ?></td></tr>
    <tr><td>Titre</td><td>&lt;?php echo $page->title ?&gt;</td><td><?php echo $page->title ?></td></tr>
    <tr><td>Template</td><td>&lt;?php echo $page->template ?&gt;</td><td><?php echo $page->template ?></td></tr>
    <tr><td>Image principale</td><td><pre>&lt;?php echo "&lt;img src='{$page->image_principale->url}' alt='{$page->image_principale->description}'&gt;" ?&gt;</pre></td><td><?php echo "<img src='{$page->image_principale->url}' alt='{$page->image_principale->description}'>" ?></td></tr>
    <tr><td>zone de texte</td><td>&lt;?php $Extra->text($page->zone_de_texte); ?&gt;</td><td><?php echo $Extra->text($page->zone_de_texte) ?></td></tr>
    <tr>
      <td>Objets enfants et satellites</td><td><pre><ul>&lt;?php foreach($page->children as $child) {
        echo "&lt;li?&gt;&lt;a href='$child->url'>$child->title&lt;/a?&gt;&lt;/li?&gt;";
        if (!$child->children == null) {
          ?&gt;&lt;ul?&gt;&lt;?php
          foreach ($child->children as $grandchild) {
            echo "&lt;li?&gt;&lt;a href='$grandchild->url'>$grandchild->title&lt;/a?&gt;&lt;/li?&gt;";
          }
          ?&gt;&lt;/ul?&gt;&lt;?php
        }
} ?&gt;</ul></pre></td>
      <td><ul><?php foreach($page->children as $child) {
        echo "<li><a href='$child->url'>$child->title</a></li>";
        if (!$child->children == null) {
          ?><ul><?php
          foreach ($child->children as $grandchild) {
            echo "<li><a href='$grandchild->url'>$grandchild->title</a></li>";
          }
          ?></ul><?php
        }
} ?></ul></td>
  </tr>
  </table>
</main>
