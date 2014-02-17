<?php

add_action('init', 'residence_register');

// Registers a Residence custom Post type.
function residence_register() {
  //Arguments to create post type.
  $args = array(
    'label' => __('Residences'),
    'singular_label' => __('Residence'),
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'rewrite' => array(
      'slug' => 'residences',
      'with_front' => false,
    ),
  );
  // Register custom type.
  register_post_type('residences' , $args);

  // Register custom taxonmy for type.
  register_taxonomy(
    'residence-type',
    array('residences'),
    array(
      'hierarchical' => true,
      'label' => 'Residence Types',
      'singular_label' => 'Residence Type',
      'rewrite' => true,
      'slug' => 'residence-type',
    ));

  // Add the Featured term only if it does not exist.
  if (term_exists('featured', 'residence-type') === NULL) {
    $featured_category_defaults = array(
      'slug' => 'featured',
      'description' => 'Denotes that this residence is supposed to appear on the front page as a featured residence. Only three will be displayed at random.',
    );
    wp_insert_term('Featured', 'residence-type', $featured_category_defaults);
  }
}

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
?>
