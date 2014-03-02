<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

// Initialize the theme.
require_once(dirname( __FILE__ ) . '/lib/init.php');

// Disable comments site-wide
//require_once('disable-comments.php');

// -- Pages
// Front Page
// Corporage Profile
// => Team
// => History
// => Awards
// --> Residences (Custom Post type)
// Contact form
// The Query
/* $post = get_post((object) array('post_name' => 'profile')); */
/* print_r($post); */
/* if (!$post) { */
/*   wp_insert_post(array( */
/*       'post_name' => 'profile', */
/*       'post_status' => 'publish', */
/*       'post_title' => 'Larry Chappell', */
/*       'post_content' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', */
/*     )); */
/* } */

/*
// Include custom home page display area's.
$args = array(
  'name' => 'Front Page Content',
  'id' => 'front-page-content',
  'description' => 'This is the main content area on the front page.',
  'class' => '',
  'before_widget' =>'<div id="%1$s"class="widget%2$s">',
  'after_widget' => '</div>',
  'before_title' => '',
  'after_title' => '',
);
register_sidebar($args);
*/
// Include custom post type
//require_once('lib/structure/residence.php');

/* // Child theme (do not remove) */
/* define('CHILD_THEME_NAME', 'Chappell Construction Theme'); */
/* define('CHILD_THEME_URL', 'http://www.nigelbanks.ca/'); */

/* // Add Viewport meta tag for mobile browsers */
/* add_action('genesis_meta', 'sample_viewport_meta_tag'); */
/* function sample_viewport_meta_tag() { */
/*   echo '<meta name="viewport" content="width=device-width, initial-scale=1.0"/>'; */
/* } */

// Add support for custom background, but hide it by default.
/* $defaults = array( */
/*   'default-color' => '000000', */
/*   'default-image' => get_stylesheet_directory_uri() . '/images/front-page-bg.png', */
/* ); */
/* add_theme_support('custom-background', $defaults); */
/* add_filter('body_class','remove_custom_bg'); */
/* function remove_custom_bg($classes) { */
/*   $index = array_search('custom-background', $classes); */
/*   unset($classes[$index]); */
/*   return $classes; */
/* } */

/* // Add HTML5 Support */
/* add_theme_support('html5'); */
// Check if the menu exists
/*
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
      }*/
