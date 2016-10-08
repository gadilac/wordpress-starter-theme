<?php

namespace Core\Customizer;

// http://hookr.io/all/#index=w&search=WP_Customize
use Core\Assets;
use WP_Customize_Control;
//use WP_Customize_Color_Control;
//use WP_Customize_Upload_Control;
use WP_Customize_Image_Control;

/*
==============
Control type
==============
(default) text
* checkbox
* textarea
* radio (pass a keyed array of values => labels to the choices argument)
* select (pass a keyed array of values => labels to the choices argument)
* dropdown-pages
*/

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
  // ==================== SECTIONS ================================ //
  $wp_customize->add_section('header',array('title'=> __('Header', 'core'), 'priority' => 30));
  $wp_customize->add_section('footer',array('title'=> __('Footer', 'core'), 'priority' => 30));
  // ==================== SETTINGS ================================ //
  $wp_customize->add_setting('footer[copyright_text]');
  $wp_customize->add_control('footer[copyright_text]', array(
    'label'      => __( 'Copyright Text'),
    'section'    => 'footer',
    'settings'   => 'footer[copyright_text]',
  ) );
  // Custom Control
  // $wp_customize->add_control(new WP_Customize_Control($wp_customize,'footer[copyright_text]', array(
  //     'label'      => __( 'Copyright Text'),
  //     'section'    => 'footer',
  //     'settings'   => 'footer[copyright_text]',
  // )));
  // ============================================================== //
}
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('core/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');
