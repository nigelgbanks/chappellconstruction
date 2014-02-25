<?php
// Do not display the default footer or the widget areas.
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_before_footer', 'genesis_footer_widget_areas');

genesis_structural_wrap( 'site-inner', 'close' );
echo '</div>'; //* end .site-inner or #inner

do_action( 'genesis_before_footer' );
do_action( 'genesis_footer' );
do_action( 'genesis_after_footer' );

echo '</div>'; //* end .site-container or #wrap

do_action( 'genesis_after' );
wp_footer(); //* we need this for plugins
?>
</body>
</html>
