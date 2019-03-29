// JS

jQuery(function(){

  // other ajax request
  jQuery("#frmPostOtherPage").on("click", function(e){
    e.preventDefault();
    jQuery.post(ajaxurl, {action:"custom_plugin", name:"Online Web Tutor", Tut:"WordPress Plugin Development"}, function(response){
      console.log(response);
    });
  });

  jQuery(document).on("click", ".btnClick", function(){
    
    var post_data = "action=custom_plugin_library&param=get_message";

    $.post(ajaxurl, post_data, function(response){
      console.log(response);
    });
  });

  $("#frmPost").validate({
    submitHandler:function(){
      // console.log($('#frmPost').serialize());
      var post_data = $('#frmPost').serialize()+'&action=custom_plugin_library&param=post_form_data';

      $.post(ajaxurl, post_data, function(response){
        var data = $.parseJSON(response);
        // console.log(data);
        console.log('Name: ' +data.txtName+ ' Email: ' +data.txtEmail);
      });
    }
  });

});