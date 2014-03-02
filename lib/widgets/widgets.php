<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

//* Include widget class files
require_once(CHILD_WIDGETS_DIR . '/acf-widget.php');
require_once(CHILD_WIDGETS_DIR . '/any-list-scroller-widget.php');
require_once(CHILD_WIDGETS_DIR . '/residence-scroller.php');

add_action('widgets_init', 'chappell_construction_load_widgets');
/**
 * Register widgets for use in this theme.
 */
function chappell_construction_load_widgets() {
  register_widget('ACF_Display_Widget');
  register_widget('Residence_Rolodex');
}
