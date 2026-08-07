<?php
/**
 * Template de page — délègue le rendu à Timber (views/page.twig).
 */
use Timber\Timber;

$context = Timber::context();
$context['post'] = Timber::get_post();
Timber::render('page.twig', $context);
