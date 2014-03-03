<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

// Force sidebar-content layout.
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content');

// Only Display the content.
remove_all_actions('genesis_entry_header');
remove_all_actions('genesis_entry_footer');

// Only show the first residence.
remove_action('genesis_after_endwhile', 'genesis_posts_nav');

add_action('genesis_loop', 'chappell_construction_residence_do_loop', 9);
/**
 * Custom Query for the Residences loop.
 */
function chappell_construction_residence_do_loop() {
  global $wp_query;
  $wp_query = new WP_Query(array(
                'post_type' => 'residences',
                'orderby' => 'title',
                'order' => 'ASC',
                'showposts' => 1,
              ));
}

// Custom Footer for the Residence in focus.
/*
add_action('genesis_footer', 'chappell_construction_footer');
function chappell_construction_footer() {
  $location = "Charlottetown Prince Edward Island";
  $content = <<<EOT
    <div id="location">Location</div>
    <div>{$location}</div>
EOT;
  echo $content;
}
*/

genesis();
?>
