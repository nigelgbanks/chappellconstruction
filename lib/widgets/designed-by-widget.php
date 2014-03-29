<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

class Designed_By_Widget extends WP_Widget {

  /**
   * Create the widget.
   */
  public function __construct() {
    $widget_options = array(
      'classname'   => 'designed-by-widget',
      'description' => __('Displays a the Designed By Advanced Custom Field.'),
    );
    $control_options = array(
      'width'   => 200,
      'height'  => 250,
    );
    parent::__construct(
      'designed_by_widget',
      __('Designed By'),
      $widget_options,
      $control_options
    );
  }

  /**
   * Settings form.
   */
  public function form($instance) {
    echo "There are no settings for this Widget.";
  }

  /**
   * Form submit hook.
   */
  public function update($new_instance, $old_instance) {
    return $new_instance;
  }

  /**
   * Display the widget.
   */
  public function widget($args, $instance) {
    global $post;
    $loop = new WP_Query(array(
              'post_type' => 'residences',
              'orderby' => 'title',
              'order' => 'ASC',
              'nopaging' => TRUE
            ));
    echo '<div id="designed-by">';
    while ($loop->have_posts()) {
      $loop->the_post();
      if (($loop->current_post == 0 && !is_single()) || is_single($post->ID)) {
         the_field('designed_by');
         break;
      }
    }
    echo '</div>';
    wp_reset_query();
  }
}
