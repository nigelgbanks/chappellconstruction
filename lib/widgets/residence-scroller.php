<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

class Residence_Rolodex extends Any_List_Scroller_Widget {

  /**
   * Holds widget settings defaults, populated in constructor.
   *
   * @var array
   */
  protected $defaults = array(
    'title' => '',
  );

  /**
   * Create the widget.
   */
  public function __construct() {
    $widget_options = array(
      'classname'   => 'residence-rolodex',
      'description' => __('Displays a scrollable list of residences which link to their posts.'),
    );
    $control_options = array(
      'width'   => 200,
      'height'  => 250,
    );
    parent::__construct(
      'residence_rolodex',
      __('Residence Rolodex'),
      $widget_options,
      $control_options
    );
  }

  /**
   * Display the widget.
   */
  public function widget($args, $instance) {
    global $post;
    // Build a list of content pass a long in the $args['list'] variable.
    $loop = new WP_Query(array(
              'post_type' => 'residences',
              'orderby' => 'title',
              'order' => 'ASC',
              'nopaging' => TRUE
            ));
    $args['list'] = array();
    $list = &$args['list'];
    while ($loop->have_posts()) {
      $loop->the_post();
      if (($loop->current_post == 0 && !is_single()) || is_single($post->ID)) {
        $title = get_the_title();
        $list[] = "<li class=\"current als-item\">{$title}</li>";
      }
      else {
        $title = sprintf('<a href="%s" title="%s" rel="bookmark">%s</a>', get_permalink(), the_title_attribute('echo=0'), get_the_title());
        $list[] = "<li class=\"als-item\">{$title}</li>";
      }
    }
    wp_reset_query();
    parent::widget($args, $instance);
  }
}

/*
// Widget for displaying the Featured Residences.
class Featured_Residences_Widget extends WP_Widget {
  public function __construct() {
    parent::__construct(
      'featured_residences',
      'Featured Residences',
      array('description' => __('Displays the Featured Residences'))
    );
  }
  public function form($instance) {
    // outputs the options form on admin
    $title = isset($instance['title']) ? $instance['title'] : 'Featured Residence';
    $title_field_id = $this->get_field_id('title');
    $title_field_name = $this->get_field_name('title');
    $label = _e('Title:');
    $value = esc_attr($title);
    $content = <<<EOT
<p>
  <label for="{$title_field_id}">{$label}</label>
  <input class="widefat" id="{$title_field_id}" name="${title_field_name}" type="text" value="{$value}" />
</p>
EOT;
    echo $content;
  }

  public function update($new_instance, $old_instance) {
    $instance = array();
    $instance['title'] = strip_tags($new_instance['title']);
    return $instance;
  }

  public function widget($args, $instance) {
    extract( $args);
    $title = apply_filters('widget_title', $instance['title']);
    echo $before_widget;
    if (!empty($title)) {
      echo $before_title . $title . $after_title;
    }
    $args= array(
      'post_type' => 'residences',
      'posts_per_page' => 1,
      'tax_query' => array(
        array(
          'taxonomy' => 'residence-type',
          'field' => 'slug',
          'terms' => 'featured',
        ),
      ),
    );
  }
}
register_widget('Featured_Residences_Widget');
*/
