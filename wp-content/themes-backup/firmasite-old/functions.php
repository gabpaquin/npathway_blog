<?php

// You can show/remove powered by wordpress
if ( !defined('FIRMASITE_POWEREDBY') )
  define('FIRMASITE_POWEREDBY', true);

/*
 * You can define subset thats limiting google fonts
 * Default: 'latin-ext' means theme will only show fonts that have 'latin-ext' support and will load 'latin-ext' while calling that font.
 * You can use multi subsets with comma seperated. Example: define('FIRMASITE_SUBSETS', 'cyrillic,cyrillic-ext');
 * You dont need to define latin. For latin only you can define as empty: define('FIRMASITE_SUBSETS', '');
 */
if ( !defined('FIRMASITE_SUBSETS') )
  define('FIRMASITE_SUBSETS', 'latin-ext');


// If you define this as false, theme will remove showcase posts from home page loop
if ( !defined('FIRMASITE_SHOWCASE_POST') )
  define('FIRMASITE_SHOWCASE_POST', true);





/* DONT REMOVE THIS LINE */
include ( get_template_directory() . '/functions/customizer-call.php');     // Customizer functions
require_once ( get_template_directory() . '/functions/init.php'); // Initial theme setup and constants

// Fix for qTranslate plugin and "Home" menu link reverting back to default language

if (function_exists('qtrans_convertURL')) {

function qtrans_in_nav_el($output, $item, $depth, $args) {

$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';

$attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';

$attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';

// Integration with qTranslate Plugin

$attributes .=!empty($item->url) ? ' href="' . esc_attr( qtrans_convertURL($item->url) ) . '"' : '';

$output = $args->before;

$output .= '<a' . $attributes . '>';

$output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;

$output .= '</a>';

$output .= $args->after;

return $output;

}

add_filter('walker_nav_menu_start_el', 'qtrans_in_nav_el', 10, 4);

}