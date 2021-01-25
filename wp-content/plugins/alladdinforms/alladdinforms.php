<?php
/**
 * Plugin Name: Alladdin-Forms
 * Description: Custom form plugin voor eindwerk.
 * Version: 2.3
 * Author: Bosschem Indy
 */

$dir = 'wp-content/plugins/alladdinforms/';

wp_register_style('alladdinforms_style', '/'.$dir.'assets/css/alladdinforms.css');
wp_enqueue_style( 'alladdinforms_style');

foreach (glob($dir . "includes/*.php") as $filename) {
  require_once($filename);
}

foreach (glob($dir . "includes/components/*/*.php") as $filename) {
  require_once($filename);
}
