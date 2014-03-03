<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

add_action('init', 'register_residence_post_type');
// Registers a Residence custom Post type.
function register_residence_post_type() {
  // Register custom post type.
  register_post_type('residences', array(
      'label' => 'Residences',
      'description' => 'Properties in which Chappell Construction have worked on and wish to profile on their site.',
      'labels' => array(
        'name' => 'Residences',
        'singular_label' => 'Residence',
      ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_nav_menus' => true,
      'capability_type' => 'post',
      'hierarchical' => false,
      'has_archive' => true,
      'supports' => array('title', 'editor', 'thumbnail'),
      'rewrite' => array(
        'slug' => 'residences',
        'with_front' => false,
      ),
    ));
}
?>
