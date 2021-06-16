<?php
/**
 * Plugin Name: Alladdin-Forms
 * Description: Custom form plugin voor eindwerk.
 * Version: 2.3
 * Author: Bosschem Indy
 */

$dir = 'wp-content/plugins/alladdinforms/';

foreach (glob($dir . "includes/*.php") as $filename) {
  require_once($filename);
}

foreach (glob($dir . "includes/components/*/*.php") as $filename) {
  require_once($filename);
}
