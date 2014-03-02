<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

/**
 * Widget to display any Custom Field Type.
 */
class ACF_Display_Widget extends WP_Widget {
  public function __construct() {
    parent::__construct(
      'acf_display',
      'Advanced Custom Field Display',
      array('description' => __('Displays the selected advanced custom field.'))
    );
  }

  public function form($instance) {
    echo "There are no settings for this Widget.";
  }

  public function update($new_instance, $old_instance) {
    return $new_instance;
  }

  public function widget($args, $instance) {
    global $post;
    echo "Testing";
  }
}
