# Thème Onzehonze

Thème WordPress minimal : **Timber 2 + ACF Pro blocks + Tailwind v3**, animations légères sans dépendance (IntersectionObserver).

## Prérequis
- WordPress + **ACF Pro** actif (requis pour les blocs)
- PHP 8.1+
- Node 18+ et Composer

## Installation
```bash
cd wp-content/themes/onzehonze
composer install      # récupère Timber 2 dans /vendor
npm install           # récupère Tailwind CLI
npm run dev           # build CSS en watch (dev)
# npm run build       # build minifié (prod)
```
Puis active le thème dans WP, crée une page, ajoute le bloc **Onzehonze → Hero – Split**.

## Comment ça marche
- `functions.php` charge Timber + les modules `/inc`.
- `inc/blocks.php` : le helper `onzehonze_register_block()` enregistre un bloc ACF rendu par un Twig, sans boilerplate. Chaque nouveau bloc = ~7 lignes.
- Les champs ACF sont versionnés en **Local JSON** dans `acf-json/` (sync auto dans WP > ACF > Field Groups).
- Le CSS Tailwind est compilé depuis `assets/src/app.css` vers `assets/dist/app.css`.

## Ajouter un bloc (recette)
1. `views/blocks/mon-bloc.twig` — le markup (utilise `f.mon_champ`, et `js-reveal` + `data-reveal-*` pour animer).
2. `acf-json/group_mon_bloc.json` — les champs, avec `location: block == acf/mon-bloc`.
3. Dans `inc/blocks.php` :
   ```php
   onzehonze_register_block([
     'name' => 'mon-bloc', 'title' => 'Mon bloc',
     'icon' => 'star-filled', 'twig' => 'blocks/mon-bloc.twig',
   ]);
   ```

## Animations
Classe `js-reveal` sur un élément + attributs optionnels :
- `data-reveal-from="left|right|up"` — direction d'entrée
- `data-reveal-delay="0.1"` — délai (s) pour une cascade
- `data-reveal-once="false"` — rejoue à chaque passage (défaut : une seule fois)

`prefers-reduced-motion` est respecté (aucune animation imposée).

## Charte (dans tailwind.config.js)
`brand.rouge #D66049 · brand.jaune #F7B449 · brand.beige #FAEAD6 · brand.nuit #2E3F4C · brand.vert #5C7B78`
→ utilitaires `bg-brand-*`, `text-brand-*`, etc.

## Blocs de la home (PDF)
Hero split (fait) · Intro centrée · Services grid · Méthode/Steps · Valeurs grid · Réalisations · Contact.
Déclarations prêtes à décommenter en bas de `inc/blocks.php`.
