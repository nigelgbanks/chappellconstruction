<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

class Any_List_Scroller_Widget extends WP_Widget {

  /**
   * Holds widget settings defaults, populated in constructor.
   *
   * @var array
   */
  protected $defaults = array(
    'title' => '',
  );

  /**
   * Build and display the settings form.
   */
  public function form($instance) {
    $title = isset($instance['title']) ? $instance['title'] : '';
    $title_field_id = $this->get_field_id('title');
    $title_field_name = $this->get_field_name('title');
    $escaped_title_value = esc_attr($title);
    $form = <<<EOT
      <label for="{$title_field_id}">Title:</label>
      <input class="widefat" id="{$title_field_id}" name="{$title_field_name}" type="text" value="{$escaped_title_value}"/>
EOT;
    echo $form;
  }

  /**
   * Update the properties of the wiget from the submitted form.
   */
  public function update($new_instance, $old_instance) {
    return array(
      'title' => strip_tags($new_instance['title']),
    );
  }

  /**
   * Display the widget.
   */
  public function widget($args, $instance) {
    $path = CHILD_IMAGES_URL;
    echo '<div id="residence-selector" class="als-container">';
    echo '<div class="als-viewport">';
    echo '<ul class="als-wrapper">';
    $list = isset($args['list']) ? $args['list'] : array();
    foreach ($list as $item) {
      echo $item;
    }
    echo '</ul>';
    echo '</div>';
    echo "<span class=\"als-next als-bottom\"><img src=\"{$path}/thin_bottom_arrow_333.png\" alt=\"next\" title=\"next\"></span>";
    echo "<span class=\"als-prev als-top\"><img src=\"{$path}/thin_top_arrow_333.png\" alt=\"prev\" title=\"previous\"></span>";
    echo '<div style="clear:both"/>';
    echo '</div>';
    $count = count($list);
    // Expose as a property.
    $visible_items = $count > 5 ? 5 : $count;
    $scrolling_items = $count > 2 ? 2 : 1;
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
