// JS

jQuery(function(){

  // MULTIPLE MEDIA UPLOAD WITH .EACH()
  // jQuery('#btnImage').on('click', function(){
  //   var images = wp.media({
  //     title: "Upload Image",
  //     multiple: true
  //   }).open().on('select', function(e){
  //     var uploadedImages = images.state().get('selection');
  //     var selectedImages = uploadedImages.toJSON();
  //     jQuery.each(selectedImages, function(index,image){
  //       console.log("Image URL: " + image.url + " and Title: " + image.title);
  //     });
  //   });
  // });

  // MULTIPLE MEDIA UPLOAD WITH .MAP()
  // jQuery('#btnImage').on('click', function(){
  //   var images = wp.media({
  //     title: "Upload Image",
  //     multiple: true
  //   }).open().on('select', function(e){
  //     var uploadedImages = images.state().get('selection');
  //     var selectedImages = uploadedImages;
  //     selectedImages.map(function(image){
  //       var itemDetails = image.toJSON();
  //       console.log(itemDetails.url);
  //     });
  //   });
  // });

  // SINGLE WP_ENQUEUE_MEDIA. APPEND IMAGE
  jQuery('#btnImage').on('click', function(){
    var images = wp.media({
      title: "Upload Image",
      multiple: false
    }).open().on('select', function(e){
      var uploadedImages = images.state().get('selection').first();
      var selectedImages = uploadedImages.toJSON();
      jQuery('#getImage').attr("src", selectedImages.url);
    });
  });

  // Single WP_ENQUEUE_MEDIA
  // jQuery('#btnImage').on('click', function(){
  //   var image = wp.media({
  //     title: "Upload Image",
  //     multiple: false
  //   }).open().on('select', function(e){
  //     var uploadedImage = image.state().get('selection').first();
  //     var selectedImage = uploadedImage.toJSON();
  //     console.log("Image Title: " + selectedImage.title + " Image URL: " + selectedImage.url + " Image Filename: " + selectedImage.filename);
  //   });
  // });



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