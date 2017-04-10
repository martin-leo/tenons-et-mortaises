# Documentation SCSS du Boilerplate

Cette documentation vise à réunir différentes informations pratiques sur SCSS en général et l'organisation de la partie SCSS de ce boilerplate.

## Architecture

L'architecture utilisée est une adpatation de celle proposée sur [sass-guidelin.es](https://sass-guidelin.es/) (7-1 pattern).

```
sass/
|
|– abstracts/
|   |– _variables.scss         # variables SASS
|   |– _functions.scss         # fonctions SASS
|   |– _mixins.scss            # mixins SASS
|   |– placeholders.scss       # placeholders SASS
|
|– base/
|   |– @fontfaces.scss         # déclaration @fontfaces.scss
|   |– _base.scss              # éléments de base_
|   |– _typographie.scss       # typographie
|   …                          # Etc.
|
|– components/
|   |– _nom-du-composant.scss  # règles du composant
|   …                          # Etc.
|
|– layout/
|   |– _nom-de-l-element.scss  # layout d'un élément particulier
|   …                          # Etc.
|
|– pages/
|   |– _nom-de-la-page.scss    # styles spécifiques à une page
|   …                          # Etc.
|
|– themes/
|   |– _theme.scss              # Theme par défaut
|   |– _nom-du-theme.scss       # autre thème
|   …                           # Etc.
|
|– vendors/
|   |– _reset.scss              # Eric Meyer's CSS reset (http://meyerweb.com/eric/tools/css/reset/reset.css)
|
`– main.scss                    # fichier CSS principal
```

## Conventions de nommage
