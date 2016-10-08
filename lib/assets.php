<?php

namespace Core\Assets;

function asset_path($filename) {
  $dist_path = dirname( get_bloginfo('stylesheet_url') ) . '/layout/assets/';
  $directory = dirname($filename) . '/';
  $file = basename($filename);
  return $dist_path . $directory . $file;
}
