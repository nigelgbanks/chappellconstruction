<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

// Force full width.
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_full_width_content');

// Use the custom background.
add_filter('body_class', function($classes) {
    $classes[] = 'custom-background';
    return $classes;
  });

// Use a custom header.
remove_action('genesis_header', 'chappell_construction_do_header');
add_action('genesis_header', 'chappell_construction_do_front_page_header');

// Display the tag line.
add_action('genesis_before_content', function() {
    echo '<div id="tag-line">' . get_bloginfo('description') . '</div>';
  });

// Only display the page content.
remove_all_actions('genesis_entry_header');
remove_all_actions('genesis_entry_footer');

genesis();
?>
