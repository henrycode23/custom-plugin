// JS

jQuery(function(){
  jQuery(document).on("click", ".btnClick", function(){
    
    var post_data = "action=custom_plugin_library&param=get_message";

    $.post(ajaxurl, post_data, function(response){
      console.log(response);
    });
  });
});