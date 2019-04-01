// JS

jQuery(function(){

  jQuery('#frmPostOtherPage').validate({
    submitHandler:function(){
      var post_data = jQuery('#frmPostOtherPage').serialize()+'&action=custom_ajax_request';
      jQuery.post(
        ajaxurl,
        post_data,
        function(response){
          var data = jQuery.parseJSON(response);
          console.log('Name: '+data.txtName+'\n'+'Email: '+data.txtEmail);
        }
      )
    }
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



// other ajax request
  // jQuery('#frmPostOtherPage').validate({
  //   submitHandler:function(){
  //     var post_data = jQuery('#frmPostOtherPage').serialize()+'&action=custom_ajax_req';
  //     jQuery.post(
  //       ajaxurl,
  //       post_data,
  //       function(response){
  //         var data = jQuery.parseJSON(response);
  //         console.log('Name: '+data.txtName+'\n'+'Email: '+data.txtEmail);
  //       }
  //     )
  //   }
  // });