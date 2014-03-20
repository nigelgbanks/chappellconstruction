<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

// Force full width.
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar');

remove_all_actions('genesis_entry_header');
add_action('genesis_entry_header', function() {
    $src = CHILD_IMAGES_URL . '/logo_med.png';
    echo "<img src='$src'/>";
  });

// Use custom image rendering.
remove_all_actions('genesis_sidebar');
add_action('genesis_sidebar', function() {
    $src = CHILD_IMAGES_URL . '/contact-page-house.jpg';
    echo "<img src='$src'/>";
  });

// Add custom css for this page.
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style(
      'custom-style',
      CHILD_CSS_URL . '/custom_script.css'
    );
    $custom_css = ".content { background-color: #0e0e0e; border-radius: 3px; padding: 1em; }";
    wp_add_inline_style('custom-style', $custom_css);
  });

// Add Location Footer.
add_action('genesis_footer', function() {
    $src = CHILD_IMAGES_URL . '/logo_small.png';
    echo "<img src='$src' class='collapsed-hide'/>";
    the_field('contact_info');
});


genesis();
?>
