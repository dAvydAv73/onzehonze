<?php
/**
 * Blocs ACF Onzehonze.
 * - Catégorie "Onzehonze"
 * - Helper onzehonze_register_block() : rendu Timber sans boilerplate répété
 * - Déclaration des blocs de la home (PDF)
 */
if (!defined('ABSPATH')) { exit; }

/* Catégorie de blocs */
add_filter('block_categories_all', function ($cats) {
  array_unshift($cats, ['slug' => 'onzehonze', 'title' => __('Onzehonze', 'onzehonze')]);
  return $cats;
}, 10);

/**
 * Enregistre un bloc ACF rendu via un template Twig.
 *
 * @param array $args name, title, twig (requis) + description, icon, keywords, supports (option.)
 */
function onzehonze_register_block(array $args) {
  add_action('acf/init', function () use ($args) {
    if (!function_exists('acf_register_block_type')) return;

    $twig  = $args['twig'];
    $label = $args['title'] ?? $args['name'];

    $base = [
      'category'       => 'onzehonze',
      'mode'           => 'preview',
      'supports'       => ['align' => ['wide', 'full'], 'anchor' => true, 'jsx' => true],
      'enqueue_assets' => 'onzehonze_enqueue_block_assets',
      'render_callback'=> function ($block, $content = '', $is_preview = false, $post_id = 0) use ($twig, $label) {
        try {
          $ctx = \Timber\Timber::context();
          $ctx['fields']        = function_exists('get_fields') ? (get_fields() ?: []) : [];
          $ctx['block']         = $block;
          $ctx['is_preview']    = (bool) $is_preview;
          $ctx['block_id']      = $block['id'] ?? ('block_' . wp_generate_uuid4());
          $ctx['block_classes'] = trim(($block['className'] ?? '') . ' ' . (!empty($block['align']) ? 'align' . $block['align'] : ''));
          \Timber\Timber::render($twig, $ctx);
        } catch (\Throwable $e) {
          if ($is_preview) {
            echo '<div style="padding:12px;border:1px solid #e11;background:#fee;white-space:pre-wrap;font:12px/1.45 monospace">'
               . 'Bloc "' . esc_html($label) . '" — erreur : ' . esc_html($e->getMessage()) . '</div>';
          }
          error_log('[bloc ' . $label . '] ' . $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine());
        }
      },
    ];

    $pass = array_intersect_key($args, array_flip([
      'name', 'title', 'description', 'icon', 'keywords', 'supports', 'category', 'mode',
    ]));

    acf_register_block_type(array_merge($base, $pass));
  });
}

/* ---------------------------------------------------------------------------
 * BLOCS DE LA HOME (PDF Onzehonze)
 * Décommente au fur et à mesure que tu crées le Twig + le JSON ACF.
 * ------------------------------------------------------------------------- */

onzehonze_register_block([
  'name'        => 'hero-split',
  'title'       => 'Hero – Split',
  'description' => 'Hero : eyebrow + titre + texte + 2 CTA à gauche, visuel à droite.',
  'icon'        => 'align-pull-left',
  'keywords'    => ['hero', 'split', 'bannière'],
  'twig'        => 'blocks/hero-split.twig',
]);

onzehonze_register_block([
  'name'        => 'cards-grid',
  'title'       => 'Cartes – Grille',
  'description' => 'Sous-titre + titre + grille de cartes (icône, couleur, titre, contenu, lien).',
  'icon'        => 'grid-view',
  'keywords'    => ['cartes', 'services', 'valeurs', 'problématique'],
  'twig'        => 'blocks/cards-grid.twig',
]);

// À venir (crée le Twig + le JSON, puis décommente) :
// onzehonze_register_block(['name'=>'intro-centered','title'=>'Intro centrée','icon'=>'align-center','twig'=>'blocks/intro-centered.twig']);
// onzehonze_register_block(['name'=>'steps','title'=>'Méthode – Étapes','icon'=>'editor-ol','twig'=>'blocks/steps.twig']);
// onzehonze_register_block(['name'=>'work-grid','title'=>'Réalisations','icon'=>'portfolio','twig'=>'blocks/work-grid.twig']);
// onzehonze_register_block(['name'=>'contact-split','title'=>'Contact','icon'=>'email','twig'=>'blocks/contact-split.twig']);
