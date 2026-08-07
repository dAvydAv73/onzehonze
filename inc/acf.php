<?php
/**
 * ACF — Local JSON versionné dans le thème (acf-json/).
 */
if (!defined('ABSPATH')) { exit; }

add_filter('acf/settings/save_json', function ($path) {
  return get_stylesheet_directory() . '/acf-json';
}, 999);

add_filter('acf/settings/load_json', function ($paths) {
  $paths[] = get_stylesheet_directory() . '/acf-json';
  return array_values(array_unique($paths));
}, 999);

// Avertit si ACF Pro n'est pas là (le thème en dépend pour les blocs)
add_action('admin_notices', function () {
  if (!function_exists('acf_register_block_type')) {
    echo '<div class="notice notice-warning"><p>Onzehonze : ACF Pro est requis pour les blocs.</p></div>';
  }
});
