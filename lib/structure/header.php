<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

// Remove the default header and use our own.
remove_action('genesis_header', 'genesis_do_header');
remove_action('genesis_after_header', 'genesis_do_nav');
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_header', 'chappell_construction_do_header');
/**
 * Render's the default header.
 */
function chappell_construction_do_header() {
  // Append logo onto the primary navigation.
  $chappel_construction_do_nav_filter = function($val, $attr, $content = NULL) {
    $nav_markup_open = genesis_markup( array(
                         'html5'   => '<nav %s>',
                         'xhtml'   => '<div id="nav">',
                         'context' => 'nav-primary',
                         'echo'    => false,
                       ) );
    $nav_markup_open .= genesis_structural_wrap( 'menu-primary', 'open', 0 );
    $nav_markup_close  = genesis_structural_wrap( 'menu-primary', 'close', 0 );
    $nav_markup_close .= genesis_html5() ? '</nav>' : '</div>';
    $logo = '<div id="nav-logo"/>';
    return $nav_markup_open . $attr . $logo . $nav_markup_close;
  };
  add_filter('genesis_do_nav', $chappel_construction_do_nav_filter, 0, 3);
  genesis_do_nav();
}

/**
 * Render's the front page header, not use anywhere else.
 */
function chappell_construction_do_front_page_header() {
  echo '<div id="front-page-header">';
  echo '<div id="logo"></div>';
  genesis_do_nav();
  echo '</div>';
}
