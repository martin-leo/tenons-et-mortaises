#!/usr/bin/env bash

# ==========
# Télécharge la dernière version de ProcessWire
# et la nettoie des fichiers non utilisés

# Téléchargement de ProcessWire
curl -LkS https://github.com/ryancramerdesign/ProcessWire/archive/master.zip -o processwire.zip

# Décompression
unzip processwire.zip

# Suppression du README.md de ProcessWire
rm ProcessWire-master/README.md

# Déplacement des données et renommage de site-blank
mv ProcessWire-master/* .
mv site-blank site

# Suppression des fichiers temporaires et non-utilisés
rm -r processwire.zip ProcessWire-master site-beginner site-classic site-default site-languages site/templates/basic-page.php site/templates/home.php site/templates/styles/main.css site/templates/scripts/main.js


# ==========
# installation des plugins ProcessWire

# Ace editor

# Téléchargement
curl -LkS https://github.com/adamkiss/InputfieldAceEditor/zipball/master -o InputFieldAceEditor.zip
# Décompression
unzip InputFieldAceEditor.zip -d site/modules
# Suppression des fichiers temporaires
rm InputFieldAceEditor.zip

# MapMarker

# Téléchargement
curl -LkS https://github.com/ryancramerdesign/FieldtypeMapMarker/zipball/master -o FieldtypeMapMarker.zip
# Décompression
unzip FieldtypeMapMarker.zip -d site/modules
# Suppression des fichiers temporaires
rm FieldtypeMapMarker.zip

# ==========
# installation des plugins NPM
npm install


# ==========
# installation de d3.js et cola.js
# téléchargement
curl -LkS 'http://d3js.org/d3.v3.min.js' -o d3.js
curl -LkS 'http://marvl.infotech.monash.edu/webcola/cola.v3.min.js' -o cola.js
# structure de donnée
mkdir additional_assets
mkdir additional_assets/js
# déplacement des fichiers
mv d3.js additional_assets/js
mv cola.js additional_assets/js

# ==========
# installation des typographies nécessaires
# structure de donnée
mkdir site/templates/fonts

# ArchivoNarrow

# téléchargement
curl -LkS 'http://omnibus-type.com/download/ArchivoNarrow-for-Web.zip' -o site/templates/fonts/ArchivoNarrow-for-Web.zip
# unzip
unzip site/assets/fonts/ArchivoNarrow-for-Web.zip -d site/templates/fonts/
# suppression du zip d'origine
rm site/templates/fonts/ArchivoNarrow-for-Web.zip

# Junicode

# téléchargement
curl -LkS 'https://sourceforge.net/projects/junicode/files/junicode/junicode-0-7-8/junicode-woff-0-7-8.zip' -o site/templates/fonts/junicode-woff-0-7-8.zip
# unzip
unzip site/templates/fonts/junicode-woff-0-7-8.zip -d site/templates/fonts/
# dossier junicode
mkdir site/templates/fonts/junicode
mv site/templates/fonts/junicode-woff/fonts/* site/templates/fonts/junicode/
# suppression du zip d'origine
rm -rf site/templates/fonts/junicode-woff site/templates/fonts/junicode-woff-0-7-8.zip

# ==========
# compilation/copie des templates/CSS/JS en version prod
grunt prod
