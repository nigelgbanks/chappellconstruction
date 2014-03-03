<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

// Child theme (do not remove)
define('CHILD_THEME_NAME', 'Chappell Construction Theme');
define('CHILD_THEME_URL', 'http://www.nigelbanks.ca/');
define('CHILD_THEME_DIR_URI', get_stylesheet_directory_uri());

add_action('genesis_init', 'chappell_construction_theme_support');
/**
 * Activates default theme features.
 */
function chappell_construction_theme_support() {
  add_theme_support('html5');
  add_theme_support('genesis-responsive-viewport');

  // Add support for custom background, but hide it by default. We will only be
  // showing it on the front page.
  add_theme_support('custom-background', array(
      'default-color' => '000000',
      'default-image' => CHILD_THEME_DIR_URI . '/images/front-page-bg.png',
    ));
  add_filter('body_class', function($classes) {
      $index = array_search('custom-background', $classes);
      if ($index !== FALSE) {
        unset($classes[$index]);
      }
      return $classes;
    });

  // Add support for one primary menu.
  add_theme_support('genesis-menus', array(
      'primary'   => __( 'Primary Navigation Menu', 'genesis' ),
    ));
}

add_action('genesis_init', 'chappell_construction_constants', 11);
/**
 * This function defines the theme constants.
 */
function chappell_construction_constants() {
  define('CHILD_IMAGES_DIR', CHILD_DIR . '/images');
  define('CHILD_LIB_DIR', CHILD_DIR . '/lib');
  define('CHILD_JS_DIR', CHILD_LIB_DIR . '/js');
  define('CHILD_CSS_DIR', CHILD_LIB_DIR . '/css');
  define('CHILD_FUNCTIONS_DIR', CHILD_LIB_DIR . '/functions');
  define('CHILD_STRUCTURE_DIR', CHILD_LIB_DIR . '/structure');
  define('CHILD_WIDGETS_DIR', CHILD_LIB_DIR . '/widgets');
  define('CHILD_LIB_URL', CHILD_URL . '/lib');
  define('CHILD_IMAGES_URL', CHILD_URL . '/images');
  define('CHILD_JS_URL', CHILD_LIB_URL . '/js');
  define('CHILD_CSS_URL', CHILD_LIB_URL . '/css');
}


add_action('genesis_init', 'chappell_construction_load_framework', 11);
/**
 * Loads all the framework files and features.
 *
 * The genesis_pre_framework action hook is called before any of the files are
 * required().
 *
 * If a child theme defines GENESIS_LOAD_FRAMEWORK as false before requiring
 * this init.php file, then this function will abort before any other framework
 * files are loaded.
 */
function chappell_construction_load_framework() {
  // Load Widgets
  require_once(CHILD_WIDGETS_DIR . '/widgets.php');
  // Load Structure
  require_once(CHILD_STRUCTURE_DIR . '/header.php');
  require_once(CHILD_STRUCTURE_DIR . '/residence.php');
  // Load Javascript
  require_once(CHILD_JS_DIR . '/load-scripts.php');
  // Load CSS
  require_once(CHILD_CSS_DIR . '/load-styles.php');

}
