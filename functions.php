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

// Add support for custom header
add_theme_support('genesis-custom-header', array(
 'width' => 1152,
 'height' => 120
));

// Remove support for a Static Front Page.
remove_theme_support('static-front-page');

// Add HTML5 Support
add_theme_support('html5');

add_action('genesis_setup','chappell_construction_theme_setup', 15);
function child_theme_setup() {
  // Add Nav to Header
  add_action('genesis_header', 'chappell_construction_nav_menus');
}

// Add Nav Menus to Header
function chappell_construction_nav_menus() {
  echo '<div class="menus">';
  wp_nav_menu(array('menu' => 'Primary'));
  echo '</div><!-- .menus -->';
}
