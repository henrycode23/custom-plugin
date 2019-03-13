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


#6 INCLUDE JS, CSS, IMAGES TO PLUGIN, 
-use PLUGIN_DIR_URL
  <?php echo PLUGIN_DIR_URL.'/assets/img/image.jpg'; ?>


#7 WP_ENQUEUE


*/