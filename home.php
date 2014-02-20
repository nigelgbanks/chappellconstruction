<?php
/**
 * Front Page
 * @package Chappell Construction
 * @author Nigel Banks
 */
// Force full width
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

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
remove_action('genesis_loop', 'genesis_do_loop');

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

add_action('genesis_loop', 'chappell_construction_do_loop');
function chappell_construction_do_loop() {
  $tagline = get_bloginfo('description');
  $content = <<<EOT
    <div id="tag-line">{$tagline}</div>
EOT;
  echo $content;
}

// I want the tag line to appear as part of the huge header.
// I want a preview of the corporate profile page here.
// I want the features home widget to be here as well.
genesis();
?>
