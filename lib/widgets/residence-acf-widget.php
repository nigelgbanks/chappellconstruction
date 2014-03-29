<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

class Residence_ACF_Widget extends WP_Widget {

  /**
   * Create the widget.
   */
  public function __construct() {
    $widget_options = array(
      'classname'   => 'residence-acf-widget',
      'description' => __('Displays a Advanced Custom Field for a Residence Post.'),
    );
    $control_options = array(
      'width'   => 200,
      'height'  => 250,
    );
    parent::__construct(
      'residence-acf-widget',
      __('Residence ACF Widget'),
      $widget_options,
      $control_options
    );
  }

  /**
   * Settings form.
   */
  public function form(array $instance) {
    $instance = wp_parse_args($instance, array('title' => '', 'field' => ''));
    $title = strip_tags($instance['title']);
    $field = format_to_edit($instance['field']);
    $title_id = $this->get_field_id('title');
    $title_label = 'Title:';
    $title_field_name = $this->get_field_name('title');
    $title_field_value = esc_attr($title);
    $field_id = $this->get_field_id('field');
    $field_label = 'Field:';
    $field_field_name = $this->get_field_name('field');
    $field_field_value = esc_attr($field);
    echo <<<EOT
<p>
  <label for="{$title_id}">{$title_label}</label>
  <input class="widefat" id="{$title_id}" name="{$title_field_name}" type="text" value="{$title_field_value}" />
</p>
<p>
  <label for="{$field_id}">{$field_label}</label>
  <input class="widefat" id="{$field_id}" name="{$field_field_name}" type="text" value="{$field_field_value}" />
</p>
EOT;
  }

  /**
   * Form submit hook.
   */
  public function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['field'] =  $new_instance['field'];
    return $instance;
  }

  /**
   * Display the widget.
   */
  public function widget($args, $instance) {
    global $post;
    extract($args);
    $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance);
    $field = $instance['field'];
    $has_content = FALSE;
    $loop = new WP_Query(array(
              'post_type' => 'residences',
              'orderby' => 'title',
              'order' => 'ASC',
              'nopaging' => TRUE
            ));
    while ($loop->have_posts()) {
      $loop->the_post();
      if (($loop->current_post == 0 && !is_single()) || is_single($post->ID)) {
        $has_content = TRUE;
        $content = "<div class='{$field}-field'>";
        $content .= get_field($field);
        $content .= '</div>';
        break;
      }
    }
    wp_reset_query();
    if ($has_content) {
      echo $before_widget;
      if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }
      echo $content;
      echo $after_widget;
    }
  }
}
