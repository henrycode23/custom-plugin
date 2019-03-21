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

  $object_array = array(
    "Name"    => "Sadang Developer",
    "Author"  => "Jack Henry Sadang",
    "ajaxurl" => admin_url("admin-ajax")
  );

  wp_localize_script( "script-handle", "online_web_tutor", $object_array );
}
add_action("init", "custom_plugin_assets");


function myjscode(){
  ?>
  <script type="text/javascript">
    // alert("Hello Online Web Tutor");
    var online_web_tutor = {"admin_url":"<?php echo admin_url('admin-ajax.php'); ?>"};
  </script>
  <?php
}
add_action("wp_head","myjscode");


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

/*
#4
HOW TO CREATE A DEFAULT/COMBINED SUBMENU/MENU PAGE
-$menu_slug must be the same


#5 INCLUDE FILES TO PLUGIN
HOW TO CREATE VIEWS OF EACH PAGE
1. create "views" folder
2. create e.g. "add_new.php" file & write views scripts
3. create define constants PLUGIN_DIR_PATH, PLUGIN_URL
  define("PLUGIN_DIR_PATH", plugin_dir_path(__FILE__));
  define("PLUGIN_URL", plugins_url());
  -echo it to see
4. include PLUGIN_DIR_PATH."views/add_new.php"; in the page function
  -types: include, include_once, require, require_once

  plugins_url() - src js,css,images
  plugin_dir_path() - include php files
  wp_enqueue_style - attach css files
  wp_enqueue_script - attach js files

#6 INCLUDE JS, CSS, IMAGES TO PLUGIN
-use PLUGIN_DIR_URL
  <?php echo PLUGIN_DIR_URL.'/assets/img/image.jpg'; ?>


#7 WP_ENQUEUE JS,CSS,IMAGES
  wp_enqueue_style()
  wp_enqueue_script()
  add_action("init", "custom_plugin_assets");

#8 AUTO GENERATE TABLES UPON ACTIVATION
  function callable()
  global $wpdb
  require_once(ABSPATH.'wp-admin/includes/upgrade.php');
  if(count($wpdb->get_var('SHOW TABLES LIKE "wp_custom_plugin"')) == 0){
  dbDelta( $sql_create_table );
  register_activation_hook( __FILE__, 'callable' );

#9 UNINSTALL TABLE UPON PLUGIN DEACTIVATION
  $wpdb->query('DROP table IF EXISTS wp_custom_plugin');
  register_deactivation_hook( __FILE__, 'callable' );
  register_uninstall_hook( __FILE__, 'callable' );
  
#10 CREATE PAGE UPON PLUGIN ACTIVATION
  page title = page slug
  wp_posts database table
  explore wp_posts table columns
  $page = array();
  $page['column_name'] = '';
  wp_insert_post($page)

#11 DELETE PAGES UPON PLUGIN DEACTIVATION/UNINSTALL
  wp_options database table
  explore wp_options table columns
  contain the wp_insert_post() into a variable named $post_id
  make the post_id with its name using add_action("name-inserted-to-wp_options", $post_id); 
  make the post_id with name, inside the wp_options database table as reference 
  add_option() - add to wp_options database table
  get_option() - retrievs an option_value based on option_name
  wp_insert_post()
  wp_delete_post() - trash a post or page

#12 WP_LOCALIZE_SCRIPT
  wp_localize_script( string $handle, string $object_name, array $l10n );
  $handle - is attached to the PLUGIN_URL with the same $handle
  admin_url() // return the admin-ajax.php  - used to handles ajax request wp-admin/admin-ajax.php
  add_action("wp_head","callable_function");

*/