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
      __('Profile Page List'),
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
    extract($args);
    $team = get_page_by_path('about-us');
    $history = get_page_by_path('about-us/goal');
    $awards = get_page_by_path('about-us/awards');
    $item = function($page) use ($post) {
      $link = sprintf('<a href="%s" rel="bookmark">%s</a>', get_permalink($page->ID), $page->post_title);
      if ($page->ID == $post->ID) {
        return "<li class=\"current als-item\">{$page->post_title}</li>";
      }
      return "<li class=\"als-item\">{$link}</li>";
    };
    $args['list'] = array(
      $item($team),
      $item($history),
      //$item($awards),
    );
    parent::widget($args, $instance);
  }
}
