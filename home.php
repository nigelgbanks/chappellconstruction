<?php
/**
 * Front Page
 * @package Chappell Construction
 * @author Nigel Banks
 */

// Force full width.
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

// Use the custom background.
add_filter('body_class','add_custom_bg');
function add_custom_bg($classes) {
  $classes[] = 'custom-background';
  return $classes;
}

// Include custom css.
add_action('wp_head', 'chappell_construction_add_custom_css_javascript');
function chappell_construction_add_custom_css_javascript() {
  $css_path = get_stylesheet_directory_uri() . '/css';
  echo <<<EOT
  <link rel="stylesheet" type="text/css" media="all" href="{$css_path}/home.css" />
EOT;
}

// Build custom header.
remove_action('genesis_after_header', 'genesis_do_nav');
remove_action('genesis_after_header', 'genesis_do_subnav');
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);
remove_action('genesis_before_footer', 'genesis_footer_widget_areas');

add_action('genesis_header', 'chappell_construction_header');
function chappell_construction_header() {
  $menu = wp_nav_menu(array('menu' => 'Primary', 'echo' => 0));
  $content = <<<EOT
    <div id="front-page-header">
      <div id="logo"></div>
      <div class="menu genesis-nav-menu">{$menu}</div>
    </div>
EOT;
  echo $content;
}

// Build custom content.
remove_action('genesis_loop', 'genesis_do_loop');
add_action('genesis_loop', 'chappell_construction_do_loop');
function chappell_construction_do_loop() {
  $tagline = get_bloginfo('description');
  $description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";

  $content = <<<EOT
    <div id="tag-line">{$tagline}</div>
    <div id="description">{$description}&nbsp;&nbsp;<a href="profile">Read More &gt;</a></div>
EOT;
  echo $content;
  dynamic_sidebar('front-page-content');
}

// I want the tag line to appear as part of the huge header.
// I want a preview of the corporate profile page here.
// I want the features home widget to be here as well.
genesis();
?>
