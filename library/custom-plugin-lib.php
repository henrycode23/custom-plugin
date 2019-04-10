<?php

$getParam = isset($_REQUEST['param']) ? $_REQUEST['param'] : '';

global $wpdb;

if(!empty($getParam)){
  if($getParam == 'savedata'){
    $name = isset($_REQUEST['name']) ? $_REQUEST['name'] : "";
    $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : "";
    $desc = isset($_REQUEST['desc']) ? htmlspecialchars($_REQUEST['desc']) : "";
    $wpdb->insert($wpdb->prefix . "custom_plugin", array(
      "name" => $name,
      "email" => $email,
      "description" => $desc
    ));
    echo json_encode(array("status" => 1, "msg" => "data saved"));
  }
}