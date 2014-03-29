<?php
/**
 * Chappell Construction.
 *
 * @author  Nigel Banks
 * @license GPL-2.0+
 * @link    http://nigelbanks.ca
 */

class Profile_Page_List extends Any_List_Scroller_Widget {

  /**
   * Create the widget.
   */
  public function __construct() {
    $widget_options = array(
      'classname'   => 'profile-page-list',
      'description' => __('Displays a list of profile pages.'),
    );
    $control_options = array(
      'width'   => 200,
      'height'  => 250,
    );
    parent::__construct(
      'profile_page_list',
      __('Sub Page List'),
      $widget_options,
      $control_options
    );
  }

  /**
   * Settings form.
   */
  public function form($instance) {
    $instance = wp_parse_args($instance, array('page' => ''));
    $pages = get_posts(array(
               'post_type' => 'page', 'post_status' => 'publish',
               'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC',
               'fields' => array('ID', 'name'),
             ));
    $page = strip_tags($instance['page']);
    $page_label = 'Page:';
    $page_field_id = $this->get_field_id('page');
    $page_field_name = $this->get_field_name('page');
    $options = array();
    // Map $Pages to the results.
    foreach ($pages as $val) {
      $children = get_page_children($val->ID, $pages);
      if (!empty($children)) {
        $options[] = array($val->ID, $val->post_title);
      }
    }
    $to_html = function($option) use ($page) {
      list($value, $label) = $option;
      $selected = selected($page, $value, FALSE);
      return "<option value='{$value}' $selected>{$label}</option>";
    };
    $options = implode("\n", array_map($to_html, $options));
    echo <<<EOT
 <label for="{$page_field_id}">{$page_label}</label>
<select name="{$page_field_name}" id="{$page_field_id}?>" class="widefat">
  $options
</select>
EOT;
  }

  /**
   * Form submit hook.
   */
  public function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['page'] = strip_tags($new_instance['page']);
    return $instance;
  }

  /**
   * Display the widget.
   */
  public function widget($args, $instance) {
    global $post;
    extract($args);
    $page = $instance['page'];
    $pages = get_posts(array(
               'post_type' => 'page', 'post_status' => 'publish',
               'numberposts' => -1, 'orderby' => 'title', 'order' => 'ASC',
               'fields' => array('ID', 'name'),
             ));
    $children = get_page_children($page, $pages);
    $item = function($page) use ($post) {
      $link = sprintf('<a href="%s" rel="bookmark">%s</a>', get_permalink($page->ID), $page->post_title);
      if ($page->ID == $post->ID) {
        return "<li class=\"current als-item\">{$page->post_title}</li>";
      }
      return "<li class=\"als-item\">{$link}</li>";
    };
    array_unshift($children, get_page($page));
    $args['list'] = array_map($item, $children);
    if (!empty($args['list'])) {
      parent::widget($args, $instance);
    }
  }
}
