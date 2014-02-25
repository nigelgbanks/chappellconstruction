<?php

add_action('init', 'residence_register');

// Registers a Residence custom Post type.
function residence_register() {
  //Arguments to create post type.
  $args = array(
    'label' => 'Residences',
    'description' => 'Properties in which Chappell Construction have worked on and wish to profile on their site.',
    'labels' => array(
      'name' => 'Residences',
      'singular_label' => 'Residence',
    ),
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
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

// Widget for selected a Residence to navigate to.
class Residence_Selector_Widget extends WP_Widget {
  public function __construct() {
    parent::__construct(
      'residence_selector',
      'Residence Selector',
      array('description' => __('Displays a scrollable list of Residences that link to their pages.'))
    );
  }

  public function form($instance) {
    echo "There are no settings for this Widget.";
  }

  public function update($new_instance, $old_instance) {
    return array();
  }

  public function widget($args, $instance) {
    global $post;
    $args = array('post_type' => 'residences', 'nopaging' => TRUE);
    $loop = new WP_Query($args);
    $current_post_name = 'belevadere-road';
    $num_residences = 0;
    echo '<div id="residence-selector" class="als-container">';
    echo '<div class="als-viewport">';
    echo '<ul class="als-wrapper">';
    while ($loop->have_posts()) {
      $loop->the_post();
      $is_current_post = $post->post_name == $current_post_name;
      if ($is_current_post) {
        $title = get_the_title();
        echo "<li class=\"current-residence als-item\">{$title}</li>";
      }
      else {
        $title = sprintf('<a href="%s" title="%s" rel="bookmark">%s</a>', get_permalink(), the_title_attribute('echo=0'), get_the_title());
        echo "<li class=\"als-item\">{$title}</li>";
      }
      $num_residences++;
    }
    echo '</ul>';
    echo '</div>';
    $path = get_stylesheet_directory_uri();
    echo "<span class=\"als-next als-bottom\"><img src=\"{$path}/images/thin_bottom_arrow_333.png\" alt=\"next\" title=\"next\"></span>";
    echo "<span class=\"als-prev als-top\"><img src=\"{$path}/images/thin_top_arrow_333.png\" alt=\"prev\" title=\"previous\"></span>";
    echo '<div style="clear:both"/>';
    echo '</div>';
    $visible_items = $num_residences > 5 ? 5 : $num_residences;
    $scrolling_items = $num_residences > 2 ? 2 : 1;
    echo <<<EOT
<script type="text/javascript">
jQuery(document).ready(function($) {
    $("#residence-selector").als({
        visible_items: $visible_items,
        scrolling_items: $scrolling_items,
        orientation: "vertical",
        circular: "no",
        autoscroll: "no",
    });
});
</script>
EOT;
  }
}
register_widget('Residence_Selector_Widget');
?>
