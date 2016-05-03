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
# compilation/copie des templates/CSS/JS en version prod
grunt prod
