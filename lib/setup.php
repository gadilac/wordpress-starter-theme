<?php

namespace Core\Setup;

use Core\Assets;

/**
 * Theme setup
 */
function setup() {
  // Make theme available for translation
  // load_theme_textdomain('core', get_template_directory() . '/lang');

  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');
  //set_post_thumbnail_size( 300, 300 );

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

  // Use main stylesheet for visual editor
  // To add custom styles edit /assets/styles/layouts/_tinymce.scss
  add_editor_style(Assets\asset_path('styles/vendor.css'));
  add_editor_style(Assets\asset_path('styles/main.css'));
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('css/vendor', Assets\asset_path('styles/vendor.css'), false, null);
  wp_enqueue_style('css/main', Assets\asset_path('styles/main.css'), false, null);

  if (is_single() && comments_open() && get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
  
  wp_enqueue_script('js/vendor', Assets\asset_path('scripts/plugins.min.js'), ['jquery'], null, true);
  wp_enqueue_script('js/main', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);
  wp_localize_script('js/main', 'ajax_object', array(
      'ajax_url' => admin_url( 'admin-ajax.php' ),
      'theme_url' => get_template_directory_uri()
  ));
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
