<?php
/**
 * Onzehonze — bootstrap
 * - Charge Timber 2 (via Composer)
 * - Charge les modules /inc
 * - Aucune logique métier : le thème ne fait qu'assembler des blocs ACF rendus en Twig.
 */

use Timber\Timber;

// Autoload Composer (Timber)
$autoload = get_template_directory() . '/vendor/autoload.php';
if (file_exists($autoload)) {
  require_once $autoload;
}

if (!class_exists(\Timber\Timber::class)) {
  add_action('admin_notices', function () {
    echo '<div class="notice notice-error"><p>Timber 2 absent. Lance <code>composer install</code> dans le thème.</p></div>';
  });
  return;
}

Timber::$dirname = ['views'];

$inc = get_template_directory() . '/inc';
require_once $inc . '/setup.php';
require_once $inc . '/assets.php';
require_once $inc . '/acf.php';
require_once $inc . '/blocks.php';

// Cache Timber off en dev/staging
if (defined('WP_ENV') && in_array(WP_ENV, ['development', 'staging'], true)) {
  Timber::$cache = false;
}
