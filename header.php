<?php
do_action( 'genesis_doctype' );
do_action( 'genesis_title' );
do_action( 'genesis_meta' );
wp_head(); //* we need this for plugins
?>
</head>
<?php
// Do not display default header.
remove_action('genesis_header', 'genesis_do_header');

// Append logo onto the primary navigation.
function chappel_construction_do_nav_filter($val, $attr, $content = NULL) {
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
}
add_filter('genesis_do_nav', 'chappel_construction_do_nav_filter', 0, 3);

genesis_markup( array(
  'html5'   => '<body %s>',
  'xhtml'   => sprintf( '<body class="%s">', implode( ' ', get_body_class() ) ),
  'context' => 'body',
) );
do_action( 'genesis_before' );

genesis_markup( array(
  'html5'   => '<div %s>',
  'xhtml'   => '<div id="wrap">',
  'context' => 'site-container',
) );

do_action( 'genesis_before_header' );
do_action( 'genesis_header' );
do_action( 'genesis_after_header' );

genesis_markup( array(
  'html5'   => '<div %s>',
  'xhtml'   => '<div id="inner">',
  'context' => 'site-inner',
) );

genesis_structural_wrap( 'site-inner' );
