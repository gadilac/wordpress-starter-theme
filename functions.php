<?php

$includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/wp_bootstrap_navwalker.php',// Bootstrap Navigation
  'lib/customizer.php' // Theme customizer
];

foreach ($includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'core'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

// =============================================================================

/**
 * Determine which pages should NOT display the sidebar
 */
 if(!function_exists('display_sidebar')){
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
}
/**
 * SUPPORT WOOCOMMERCE
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);

function my_theme_wrapper_start(){ echo '<main class="main">'; }
function my_theme_wrapper_end(){ echo '</main>';}
function woocommerce_support(){ add_theme_support('woocommerce'); }
add_action('after_setup_theme', 'woocommerce_support');

// ============ SVG
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// ============ Remove Width and Height Attributes From Inserted Images
function remove_width_attribute($html)
{
    $html = preg_replace('/(width|height)="\d*"\s/', "", $html);
    return $html;
}
add_filter('post_thumbnail_html', 'remove_width_attribute', 10);
add_filter('image_send_to_editor', 'remove_width_attribute', 10);

// ============ Stop Compressing JPEG Files
add_filter('jpeg_quality', function($arg){return 100;});

// =============  Bootstrap WP-Pagination
function bs3_pagination($html)
{
    $out = '';
    $out = str_replace("<div", "", $html);
    $out = str_replace("class='wp-pagenavi'>", "", $out);
    $out = str_replace("<a", "<li><a", $out);
    $out = str_replace("</a>", "</a></li>", $out);
    $out = str_replace("<span", "<li class=\"active\"><a href=\"\" ", $out);
    $out = str_replace("</span>", "</a></li>", $out);
    $out = str_replace("</div>", "", $out);

    return '<nav class="pagination-wrap"><ul class="pagination">' . $out . '</ul></nav>';
}
add_filter('wp_pagenavi', 'bs3_pagination', 10, 2);
