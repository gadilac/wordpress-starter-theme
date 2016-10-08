<?php

function asset_path($filename) {
  $dist_path = dirname( get_bloginfo('stylesheet_url') ) . '/layout/assets/';
  $directory = dirname($filename) . '/';
  $file = basename($filename);
  return $dist_path . $directory . $file;
}
  
/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    is_page_template(array('template-about.php','template-contact.php')),
  ]);

  return apply_filters('display_sidebar', $display);
}

// Register wp_nav_menu() menus
// http://codex.wordpress.org/Function_Reference/register_nav_menus
register_nav_menus([
	'primary_navigation' => __('Primary Navigation', 'core')
]);
 
/**
 * Clean up the_excerpt().
 */
//function excerpt_more()
//{
//    return '&hellip;';
//}
//add_filter('excerpt_more', __NAMESPACE__.'\\excerpt_more');
 
 /**
 * Register sidebars
 */
function widgets_init() {
  register_sidebar([
    'name'          => __('Primary', 'core'),
    'id'            => 'sidebar-primary',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);

  register_sidebar([
    'name'          => __('Footer', 'core'),
    'id'            => 'sidebar-footer',
    'before_widget' => '<section class="widget %1$s %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>'
  ]);
}
add_action('widgets_init', __NAMESPACE__ . '\\widgets_init');

// Enable post formats
// http://codex.wordpress.org/Post_Formats
// add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

// Enable support for custom logo.
  add_theme_support( 'custom-logo', array(
	'height'      => 96,
	'width'       => 90,
	'flex-height' => true,
  ));
  function has_logo(){
	  return !empty(get_theme_mod('custom_logo'));
  }
  function the_logo(){
	  $custom_logo_id = get_theme_mod('custom_logo');
	  $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
	  echo $image[0];
  }
  
/** ====== GOOGLE FONT ====== **/

function add_google_fonts() {
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300', false ); 
}
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

/** ====== SOCIAL NAVIGATION ====== **/
/*
register_nav_menus([
	'social_navigation' => __('Social Navigation', 'queenie')
]);
*/

/** ====== ADDON ASSETS ========== **/
function addon_assets(){
	wp_enqueue_script('js/swiper', asset_path('vendor/Swiper/dist/js/swiper.jquery.min.js'), ['jquery'], null, true);
}
add_action('wp_enqueue_scripts','addon_assets', 90);



/** ======================================================================= **/
/** =============================== FUNCTIONS ============================= **/
/** ======================================================================= **/
