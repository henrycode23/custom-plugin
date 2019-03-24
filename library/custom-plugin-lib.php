<?php

$getParam = isset($_REQUEST['param']) ? $_REQUEST['param'] : '';

if(!empty($getParam)){
  if($getParam == "get_message"){
    echo json_encode(array(
      "name"    => "Online Web Tutor",
      "author"  => "Sanjay Kumar"
    ));
    die;
  }

  if($getParam == "post_form_data"){
    // print_r($_REQUEST);
    echo json_encode($_REQUEST);
    die;
  }
}