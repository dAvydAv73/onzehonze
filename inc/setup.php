<?php
/**
 * Supports thème, menus, et contexte Timber global.
 */
if (!defined('ABSPATH')) { exit; }

add_action('after_setup_theme', function () {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form', 'gallery', 'caption', 'style', 'script']);
  add_theme_support('align-wide');

  register_nav_menus([
    'primary' => __('Menu principal', 'onzehonze'),
    'footer'  => __('Menu pied de page', 'onzehonze'),
  ]);

  load_theme_textdomain('onzehonze', get_template_directory() . '/languages');
});

// Contexte Timber partagé par toutes les vues
add_filter('timber/context', function ($ctx) {
  $ctx['site']      = new \Timber\Site();
  $ctx['is_mobile'] = wp_is_mobile();
  $ctx['menu']      = \Timber\Timber::get_menu('primary');
  $ctx['menu_footer'] = \Timber\Timber::get_menu('footer');
  return $ctx;
});
