<?php
/**
 * Enqueue CSS/JS (front + éditeur de blocs).
 * Le CSS provient du build Tailwind CLI (assets/dist/app.css).
 */
if (!defined('ABSPATH')) { exit; }

function onzehonze_asset_uri($rel) {
  return get_template_directory_uri() . '/' . ltrim($rel, '/');
}
function onzehonze_asset_ver($rel) {
  $path = get_template_directory() . '/' . ltrim($rel, '/');
  return file_exists($path) ? filemtime($path) : '1.0.0';
}

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('onzehonze/app', onzehonze_asset_uri('assets/dist/app.css'), [], onzehonze_asset_ver('assets/dist/app.css'));
  wp_enqueue_script('onzehonze/reveal', onzehonze_asset_uri('assets/js/reveal.js'), [], onzehonze_asset_ver('assets/js/reveal.js'), true);
});

// Styles aussi dans l'éditeur pour un aperçu fidèle des blocs
add_action('enqueue_block_assets', function () {
  if (is_admin()) {
    wp_enqueue_style('onzehonze/app', onzehonze_asset_uri('assets/dist/app.css'), [], onzehonze_asset_ver('assets/dist/app.css'));
  }
});

// Handle générique réutilisé par les blocs (enqueue_assets)
function onzehonze_enqueue_block_assets() {
  wp_enqueue_style('onzehonze/app');
}
