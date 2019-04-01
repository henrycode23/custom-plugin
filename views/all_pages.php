<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>

  <style>
    #frmPostOtherPage label.error{
      color: red;
    }
  </style>

  <!-- <script>
    var ajaxurl = "<?php // echo admin_url('admin-ajax.php'); ?>"; // 
  </script> -->
</head>
<body>

<?php

?>

  <div class="container">
    <form action="" id="frmPostOtherPage">
      <div class="form-group">
        <label for="txtName">Name for other page:</label>
        <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Enter Name" required>
      </div>
      <div class="form-group">
        <label for="txtEmail">Email for other page:</label>
        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Enter Email" required>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>