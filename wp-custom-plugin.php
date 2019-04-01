<?php
/**
 * @package Custom Plugin
 */
/*
Plugin Name: Custom Plugin
Plugin URI: https://facebook.com/jackhenry.sadang
Description: This is our custom plugin
Version: 1.0.0
Author: Jack Henry Sadang
Author URI: https://facebook.com/jackhenry.sadang
License: GPLv2 or later
Text Domain: custom-plugin
*/

define("PLUGIN_DIR_PATH", plugin_dir_path( __FILE__ ));
define("PLUGIN_DIR_URL", plugin_dir_url( __FILE__ ));
define("PLUGIN_VERSION", "1.0");

function add_my_custom_menu(){
  add_menu_page(
    "customplugin", // string $page_title
    "Custom Plugin", // string $menu_title
    "manage_options", // string $capability
    "custom-plugin", // string $menu_slug
    "custom_admin_view", // callable $function = ''
    "dashicons-dashboard", // string $icon_url = ''
    11 // int $position = null
  ); 

  add_submenu_page( 
    "custom-plugin", // $parent_slug:string
    "Add New", // $page_title:string
    "Add New", // $menu_title:string
    "manage_options", // $capability:string
    "custom-plugin", // $menu_slug:string
    "add_new_function" // $function:callable 
  );

  add_submenu_page( 
    "custom-plugin", // $parent_slug:string
    "All Pages", // $page_title:string
    "All Pages", // $menu_title:string
    "manage_options", // $capability:string
    "all-pages", // $menu_slug:string
    "all_pages_function" // $function:callable 
  );

}
add_action("admin_menu","add_my_custom_menu");

function custom_admin_view(){
  echo "<h1>Hello Jack Henry Sadang, Welcome to Online Web Tutor</h1>";
}

function add_new_function(){
  include_once PLUGIN_DIR_PATH."/views/add_new.php";
}

function all_pages_function(){
  include_once PLUGIN_DIR_PATH."/views/all_pages.php";
}

function custom_plugin_assets(){
  wp_enqueue_style(
    "style-handle", // $handle:string
    PLUGIN_DIR_URL."assets/css/style.css", // $src:string
    "", // $deps:array
    PLUGIN_VERSION // $ver:string|boolean|null, $media:string 
  );

  wp_enqueue_script( 
    "script-handle", 
    PLUGIN_DIR_URL."assets/js/script.js",
    "", // $deps:array, 
    PLUGIN_VERSION, // $ver:string|boolean|null,
    true // true or false; $in_footer:boolean 
  );

  wp_localize_script( "script-handle", "ajaxurl", admin_url("admin-ajax.php") );
}
add_action("init", "custom_plugin_assets");



add_action( 'wp_ajax_custom_ajax_request', 'custom_ajax_request' );
function custom_ajax_request(){
  echo json_encode($_REQUEST);
  wp_die();
}




// custom_ajax_req from js file
// add_action( 'wp_ajax_custom_ajax_req', 'custom_ajax_req_fn' );
// function custom_ajax_req_fn(){
//   echo json_encode($_REQUEST);
//   wp_die();
// }



if(isset($_REQUEST['action'])){
  switch($_REQUEST['action']){
    case 'custom_plugin_library' :
      add_action( 'admin_init', 'add_custom_plugin_library' );
      function add_custom_plugin_library(){
        global $wpdb;
        include_once PLUGIN_DIR_PATH. 'library/custom-plugin-lib.php';
      }
      break;
  }
}


add_action( 'wp_ajax_custom_plugin', 'prefix_ajax_custom_plugin');
function prefix_ajax_custom_plugin(){
  print_r($_REQUEST);
  wp_die();
}


// Table Generating Code
function custom_plugin_tables(){
  global $wpdb;

  require_once(ABSPATH.'wp-admin/includes/upgrade.php');

  if(count($wpdb->get_var('SHOW TABLES LIKE "wp_custom_plugin"')) == 0){
    $sql_create_table = 'CREATE TABLE `wp_custom_plugin` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(255) DEFAULT NULL,
      `email` varchar(255) DEFAULT NULL,
      `phone` varchar(255) DEFAULT NULL,
      `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`)
     ) ENGINE=InnoDB DEFAULT CHARSET=latin1';
     
    dbDelta( $sql_create_table );
  }
}
register_activation_hook( __FILE__, 'custom_plugin_tables' );



function deactivate_table(){
  global $wpdb;
  $wpdb->query('DROP table IF EXISTS wp_custom_plugin');

  $the_post_id = get_option( "custom_plugin_page_id" );
  if(!empty($the_post_id)){
    wp_delete_post( $the_post_id, true ); // wp_posts > ID = delete
  }

}
register_deactivation_hook( __FILE__, 'deactivate_table' );



function create_page(){
  $page = array();
  $page['post_title'] = 'Custom Plugin Online Web Tutor';
  $page['post_content'] = 'Learning Platform for WordPress Customization for Themes, Plugin and Widgets';
  $page['post_status'] = 'publish';
  $page['post_slug'] = 'custom-plugin-online';
  $page['post_type'] = 'page';

  $post_id = wp_insert_post($page); // wp_posts > ID

  add_option( 'custom_plugin_page_id', $post_id ); // wp_options > option_value = $post_id, option_name = custom_plugin_page_id
}
register_activation_hook( __FILE__, "create_page" );


function custom_plugin_func(){
  include_once PLUGIN_DIR_PATH. '/views/shortcode_template.php';
}
add_shortcode( 'custom-plugin', 'custom_plugin_func' );
// Simplest example of a shortcode tag using the API: [footag foo="bar"]
function footag_func( $atts ){
  return "foo = {$atts['foo']}";
}
add_shortcode( 'footag', 'footag_func' );
// Example with nice attribute defaults: [bartag foo="bar"]
function bartag_func( $atts ){
  $atts = shortcode_atts( array(
    'foo' => 'no foo',
    'baz' => 'default baz'
  ), $atts, 'bartag' );
  return "foo = {$atts['foo']}";
}
add_shortcode( 'bartag', 'bartag_func' );
// Example with enclosed content: [baztag]content[/baztag]
// function baztag_func( $atts, $content = "" ){
//   return "content = $content";
// }
// add_shortcode( 'baztag', 'baztag_func' );
// If your plugin is designed as a class, write as follows:
class MyPlugin {
  public static function baztag_func( $atts, $content = "" ){
    return "content = $content";
  }
}
add_shortcode( 'baztag', array( 'MyPlugin', 'baztag_func' ) );