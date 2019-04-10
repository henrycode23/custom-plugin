// JS

jQuery(function(){

  jQuery("#frmPost").validate({
    submitHandler:function(){

      var name = jQuery("#txtName").val();
      var email = jQuery("#txtEmail").val();
      var description = encodeURIComponent(tinyMCE.get("description_id").getContent());
      
      var post_data = "action=custom_plugin_library&param=savedata&name="+name+"&email="+email+"&desc="+description;
      jQuery.post(ajaxurl, post_data, function(response){
        console.log(response);
      });

    }
  });

});

// jQuery("#frmPost").validate({
//   submitHandler:function(){
//     var post_data = "action=custom_plugin_library&param=savedata&"+jQuery("#frmPost").serialize();
//     jQuery.post(ajaxurl, post_data, function(response){
//       console.log(response);
//     });

//   }
// });

// jQuery("#frmPost").validate({
//   submitHandler:function(){

//     var name = jQuery("#txtName").val();
//     var email = jQuery("#txtEmail").val();
//     var description = encodeURIComponent(tinyMCE.get("description_id").getContent());
    
//     var post_data = "action=custom_plugin_library&param=savedata&name="+name+"&email="+email+"&desc="+description;
//     jQuery.post(ajaxurl, post_data, function(response){
//       console.log(response);
//     });

//   }
// });