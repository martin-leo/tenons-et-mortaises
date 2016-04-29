<main>
  <table>
    <tr><td>$data->id</td><td><?php echo $data->id ?></td></tr>
    <tr><td>$data->titre</td><td><?php echo $data->titre ?></td></tr>
    <tr><td>$data->template</td><td><?php echo $data->template ?></td></tr>
    <tr><td>$data->date_de_publication_tem</td><td><?php echo $data->date_de_publication_tem ?></td></tr>
    <tr><td>$Extra->text($data->contenu)</td><td><?php echo $Extra->text($data->contenu) ?></td></tr>
    <tr><td>$data->theme</td><td><?php echo $data->theme ?></td></tr>
    <tr><td>$data->themes_secondaires</td><td><?php echo $data->themes_secondaires ?></td></tr>
    <tr><td><pre>foreach ($data->themes_secondaires->liste as $theme) {
      echo print_theme($theme) . '&lt;br&gt;';
    };</pre></td><td><?php foreach ($data->themes_secondaires->liste as $theme) {
      echo $theme . '<br>';
    }; ?></td></tr>
    <tr><td>$data->objets_associes</td><td><?php echo $data->objets_associes ?></td></tr>
    <tr><td>$data->image_principale</td><td><?php echo $data->image_principale ?></td></tr>
    <tr><td>$data->images</td><td><?php echo $data->images ?></td></tr>
    <tr><td>$data->zone_de_texte)</td><td><?php echo $Extra->text($data->zone_de_texte) ?></td></tr>
  </table>
</main>
