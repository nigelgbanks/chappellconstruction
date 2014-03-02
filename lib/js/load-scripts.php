<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

add_action('wp_enqueue_scripts', 'chappell_construction_register_scripts');
/**
 * Register the scripts that the theme will use.
 */
function chappell_construction_register_scripts() {
  $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
  wp_register_script('als', CHILD_JS_URL . "/jquery.als-1.3$suffix.js", array('jquery'), '1.3.0', TRUE);
}

add_action('wp_enqueue_scripts', 'chappell_construction_load_scripts');
/**
 * Enqueue the scripts used on the front-end of the site.
 */
function chappell_construction_load_scripts() {
  if (is_active_widget(FALSE, FALSE, 'residence_rolodex')) {
    wp_enqueue_script('als');
  }
}
