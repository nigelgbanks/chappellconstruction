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

//remove_action('genesis_footer', 'genesis_do_footer');
//remove_action('genesis_before_footer', 'genesis_footer_widget_areas');

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
