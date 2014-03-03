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
    global $post;
    echo "There are no settings for this Widget.";
    print_r(api_acf_get_field_groups());
    // Build a list of content pass a long in the $args['list'] variable.
    $wp_query = new WP_Query(array(
              'post_type' => 'acf',
              'nopaging' => TRUE
            ));
    $data = array();
    while ($wp_query->have_posts()) {
      $wp_query->the_post();
      $data[] = array(
        //'post' => $post,
        'fields' => get_field_objects(13),//$post->id),
      );
    }
    //print_r($data);
    wp_reset_query();
  }

  public function update($new_instance, $old_instance) {
    return $new_instance;
  }

  public function widget($args, $instance) {
    global $post;
    echo "Testing";
  }
}
