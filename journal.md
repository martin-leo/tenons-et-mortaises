# Journal de mise en place

## Ingrédients

### Logiciels

* ProcessWire
* Git
* Grunt

### Données, fichiers

* ProcessWire - [README.md]
* .gitignore
* gruntfile.js

## Opérations

* mise en place du .gitignore
* mise en place du fichier gruntfile
* mise en place de la structure MVC
* npm init

> npm init
> npm install grunt-contrib-concat --save-dev
> npm install grunt-contrib-sass --save-dev
> npm install grunt-contrib-watch --save-dev
> npm install google-closure-compiler --save-dev
> npm install grunt-contrib-copy --save-dev

* .jscsrc

> {
>     "preset": "airbnb",
>     "requireCamelCaseOrUpperCaseIdentifiers": null,
> }

* initialisation git
* installation PW avec le template site-blank
* problème rencontré : pas configuré l'admin pour être accessible avec /admin et donc accessible avec /processwire
* modules :
  * markdown :
    * installation du module ace Text editor
      * téléchargement @ http://modules.processwire.com/modules/inputfield-ace-editor/
      * dézip et placement dans src/site/modules
  * MapMarker
    * téléchargement : http://modules.processwire.com/modules/fieldtype-map-marker/
    * dézip et placement dans src/site/modules
  * Repeater (Field type), fourni avec Processwire

### MVC

#### variables

##### view/common/header.php

* $lang : code langue (fr, en, ...)
* $page_title : titre de la page (balise <title>)

##### view/common/footer.php

### ProcessWire

#### Fields

* auteur, Text
* auteurs, Repeater
* contenu, Textarea
* date_de_debut, Datetime
* date_de_fin, Datetime
* date_de_publication_originale, datetime
* date_de_publication_tem, Datetime
* fichier, File
* images, Image
* image_principale, Image
* localisation, MapMarker
* mots_cles, Page
* objet_principal, Page
* objets_associes, Page
* origine, text
* themes_secondaires, Page
* title, PageTitle
* nature, Page
* URIs, Repeater
* URI, URL

#### Templates

* racine, title, Textarea
* template_generique
