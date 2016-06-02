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
# compilation/copie des templates/CSS/JS en version prod
grunt prod
