<?php
/**
 * Plugin Name: Alladdin
 * Description: Code voor eindwerk.
 * Version: 1.3
 * Author: Bosschem Indy
 */

$dir = 'wp-content/plugins/alladdin/';

wp_register_style('Alladdin_styling', '/'.$dir.'assets/css/style.css', array(), rand(111,9999), 'all' );
wp_enqueue_style( 'Alladdin_styling');

wp_enqueue_script( 'JQuery', '/'.$dir.'assets/js/JQuery.js');

foreach (glob($dir . "includes/*.php") as $filename) {
  require_once($filename);
}

foreach (glob($dir . "includes/components/*/*.php") as $filename) {
  require_once($filename);
}
