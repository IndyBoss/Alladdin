<?php
/**
 * Plugin Name: Alladdin
 * Description: Code voor eindwerk.
 * Version: 1.3
 * Author: Bosschem Indy
 */


function my_scripts() {
  wp_enqueue_script( 'JQuery', '/wp-content/plugins/alladdin/assets/js/JQuery.js');
  wp_register_style('Alladdin_styling', '/wp-content/plugins/alladdin/assets/css/style.css', array(), rand(111,9999), 'all' );
  wp_enqueue_style( 'Alladdin_styling');
}
add_action( 'wp_enqueue_scripts', 'my_scripts' );


$dir = 'wp-content/plugins/alladdin/';
foreach (glob($dir . "includes/*.php") as $filename) {
  require_once($filename);
}
foreach (glob($dir . "includes/components/*/*.php") as $filename) {
  require_once($filename);
}


/**
* Register Blocks
*/
add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {
$dir = 'wp-content/plugins/alladdin/';

    // Check function exists.
    if( function_exists('acf_register_block_type') ) {
        acf_register_block_type(array(
          'name'              => 'questions',
          'title'             => __('Questions'),
          'description'       => __('A custom questions block.'),
          'render_template'   => $dir.'includes/blocks/questions/questions.php',
          'category'          => 'common',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'questions', 'quote' )
        ));
        acf_register_block_type(array(
          'name'              => 'home_top',
          'title'             => __('Home top'),
          'description'       => __('A custom home banner block.'),
          'render_template'   => $dir.'includes/blocks/home/home_top.php',
          'category'          => 'common',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'home_top', 'quote' )
        ));
        acf_register_block_type(array(
          'name'              => 'home_partners',
          'title'             => __('Home partners'),
          'description'       => __('A custom home partners block.'),
          'render_template'   => $dir.'includes/blocks/home/home_partners.php',
          'category'          => 'common',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'home_partners', 'quote' )
        ));
        acf_register_block_type(array(
          'name'              => 'home_mission',
          'title'             => __('Home mission'),
          'description'       => __('A custom home mission block.'),
          'render_template'   => $dir.'includes/blocks/home/home_mission.php',
          'category'          => 'common',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'home_mission', 'quote' )
        ));
        acf_register_block_type(array(
          'name'              => 'home_profiles',
          'title'             => __('Home profiles'),
          'description'       => __('A custom home profiles block.'),
          'render_template'   => $dir.'includes/blocks/home/home_profiles.php',
          'category'          => 'common',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'home_profiles', 'quote' )
        ));
        acf_register_block_type(array(
          'name'              => 'home_bottom',
          'title'             => __('Home bottom'),
          'description'       => __('A custom home bottom block.'),
          'render_template'   => $dir.'includes/blocks/home/home_bottom.php',
          'category'          => 'common',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'home_bottom', 'quote' )
        ));
        acf_register_block_type(array(
          'name'              => 'store',
          'title'             => __('Store'),
          'description'       => __('A custom store block.'),
          'render_template'   => $dir.'includes/blocks/store/store.php',
          'category'          => 'common',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'store', 'quote' )
        ));
        acf_register_block_type(array(
          'name'              => 'paid',
          'title'             => __('Paid'),
          'description'       => __('A custom paid block.'),
          'render_template'   => $dir.'includes/blocks/store/paid.php',
          'category'          => 'common',
          'icon'              => 'admin-comments',
          'keywords'          => array( 'paid', 'quote' )
        ));
    }
}
?>
