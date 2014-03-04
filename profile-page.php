<?php
/**
 * Template Name: Profile Page
 * Description: A Page Template for the Profile section of the site.
 */

// Force sidebar-content layout.
add_filter('genesis_pre_get_option_site_layout', '__genesis_return_sidebar_content');

// Only Display the content.
remove_all_actions('genesis_entry_header');
remove_all_actions('genesis_entry_footer');

genesis();
