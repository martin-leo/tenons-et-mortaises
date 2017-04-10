# abstracts

Ce dossier regroupe les variables, fonctions, mixins et placeholders.

---

## variables

Une variable SASS est constitué du caractère $, suivi d'un identificateur, d'un deux-points (:) et enfin d'une valeur

SASS supporte 7 principaux types de valeurs :

* nombres (ex. : 1.0, 10, 1em)
* chaînes de caractère (ex. : "abc", 'abc', abc)
* couleurs (ex. : blue, #04a3f9, rgba(255, 0, 0, 0.5))
* booléens (true, false)
* nulls (ex. : null)
* listes de valeurs, séparées par des espaces ou virgules (ex. : 1.5em 1em 0 2em, Helvetica, Arial, sans-serif)
* maps (ex. : (clé-1: valeur-1, clé-2: valeur-2))

### exemple de variables SASS :

#### définition

```scss
$namespace-nom-de-la-variable: 10vw;

$namespace-map: (
  clé: 10vh,
  autre-clé: autre-valeur
);
```

#### usage

```scss
.mon-module {
  width: $namespace-nom-de-la-variable;
  height: map-get($namespace-map, clé);
}
```

### voir aussi

* https://sass-lang.com/documentation/file.SASS_REFERENCE.html#data_types

---

## fonctions

Les fonctions SASS retournent une valeur (là où les mixins SASS retournent des règles CSS).

### exemple de fonction SASS :

#### définition

```scss
@function nom-de-la-fonction ( $argument-1, $argument-2 ) {
  @return $argument-1 + $argument-2
}
```

#### usage

```scss
.mon-module {
  width: nom-de-la-fonction ( 40%, 60% );
}
```

### voir aussi

* http://thesassway.com/advanced/pure-sass-functions

---

## mixins

Les mixins SASS retournent des règles CSS (là où les fonctions SASS retournent des valeurs).

### exemple de mixin SASS :

#### définition

```scss
@mixin nom-de-la-fonction ( $argument-1, $argument-2 ) {
  // ce que fait la mixin
  // type des arguments
  width: $argument-1;
  height: $argument-2;
}
``

#### usage

```scss
.mon-module {
  @include nom-de-la-fonction ( 100%, 100% );
}
```

### voir aussi

* http://thesassway.com/advanced/pure-sass-functions

---

## placeholders

Les placeholders sont des déclarations CSS qui n'ont pas de sélecteur. Un placeholder qui n'est pas appelé via la directive @extend n'apparaitra pas dans le CSS en sortie.

L'utilisation de @extend évite la duplication de code.

### exemple :

#### définition

```scss
%namespace-nom-du-placeholder {
  propriété: valeur;
}
```

#### usage

```scss
sélecteur {
  @extend %namespace-nom-du-placeholder;
  width: 100%;
}

autre-sélecteur {
  @extend %namespace-nom-du-placeholder;
  width: 50%;
}
```

#### code CSS généré

```css
sélecteur, autre-sélecteur {
  propriété: valeur;
}

sélecteur {
  width: 100%;
}

autre-sélecteur {
  width: 50%;
}
```

### voir aussi

* http://thesassway.com/intermediate/understanding-placeholder-selectors
* https://sass-lang.com/documentation/file.SASS_REFERENCE.html#extend
