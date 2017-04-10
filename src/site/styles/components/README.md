# composant

## abstraction (placeholder) générique

Ici on définit le composant générique.

```scss
%composant {
  // les propriétés générales du composant
  margin: 10vw;
  border: 1px solid black
}
```

## variantes (placeholders aussi)

Les variantes sont constituées de déclarations qui vont prendre le pas sur la version principale du composant.

```scss
%--variante {
  @extend %composant;
  margin: 0;
  border-color: red;
}

%--autre-variante {
  @extend %composant;
  margin: 0;
  border-color: blue;
}
```

## déclaration en bonne et due forme

```scss
.composant {
  // le composant générique : .composant
  @extend %composant;

  &--variante {
    // variante 1 : .composant--variante
    @extend %--variante;
  }

  &--autre-variante {
    // variante 2 : .composant--autre-variante
    @extend %--autre-variante;
  }
}
```

## sortie

```css
.composant--variante, .composant--autre-variante, .composant {
  margin: 10vw;
  border: 1px solid black;
}

.composant--variante {
  margin: 0;
  border-color: red;
}

.composant--autre-variante {
  margin: 0;
  border-color: blue;
}
```

## notes

on pourrait considérer l'usage de placeholders dans abstracts/placeholders pour des traits qui pourraient faire l'objet de leur propre déclaration que l'on associerait à plusieurs sélecteurs plutôt que de dupliquer les déclarations. (dupliquer les sélecteurs plutôt que les déclarations).
