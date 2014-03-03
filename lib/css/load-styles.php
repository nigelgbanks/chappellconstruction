<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

add_action('genesis_meta', 'chappell_construction_register_stylesheets');
/**
 * Registers stylesheets for custom types / etc.
 */
function chappell_construction_register_stylesheets() {
  wp_register_style('home', CHILD_CSS_URL . '/home.css', array(), 1.0);
  wp_register_style('residence', CHILD_CSS_URL . '/residence.css', array(), 1.0);
}

add_action('genesis_meta', 'chappell_construction_load_stylesheets');
/**
 * Loads stylesheets for custom types / etc.
 */
function chappell_construction_load_stylesheets() {
  if (is_front_page()) {
    add_action('wp_enqueue_scripts', 'chappell_construction_enqueue_front_page_stylesheet', 6);
  }
  if (get_post_type() == 'residences') {
    add_action('wp_enqueue_scripts', 'chappell_construction_enqueue_residence_stylesheet', 6);
  }
}

/**
 * Load the stylesheets required for the residence view.
 */
function chappell_construction_enqueue_residence_stylesheet() {
  wp_enqueue_style('residence');
}

/**
 * Load the stylesheets required for the front page view.
 */
function chappell_construction_enqueue_front_page_stylesheet() {
  wp_enqueue_style('home');
}
