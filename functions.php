<?php

// Start the engine
require_once(get_template_directory() . '/lib/init.php');

// Disable comments site-wide
require_once('disable-comments.php');

// Include custom post type
require_once('residence.php');

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Chappell Construction Theme');
define('CHILD_THEME_URL', 'http://www.nigelbanks.ca/');

// Add Viewport meta tag for mobile browsers
add_action('genesis_meta', 'sample_viewport_meta_tag');
function sample_viewport_meta_tag() {
  echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>';
}

// Add support for custom background
$defaults = array(
  'default-color' => '000000',
  'default-image' => get_stylesheet_directory_uri() . '/images/front-page-bg.png',
);
add_theme_support('custom-background', $defaults);

// Add HTML5 Support
add_theme_support('html5');

// Check if the menu exists
$menu_exists = wp_get_nav_menu_object('Main');

// If it doesn't exist, let's create it.
if (!$menu_exists) {
  $menu_id = wp_create_nav_menu('Main');

  // Set up default menu items
  wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Home'),
      'menu-item-classes' => 'home',
      'menu-item-url' => home_url( '/' ),
      'menu-item-status' => 'publish'));

  wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Corporate Profile'),
      'menu-item-url' => home_url( '/profile/' ),
      'menu-item-status' => 'publish'));

  wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Residences'),
      'menu-item-url' => home_url( '/residences/' ),
      'menu-item-status' => 'publish'));

  wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' =>  __('Contact'),
      'menu-item-url' => home_url( '/contact/' ),
      'menu-item-status' => 'publish'));
}
?>
