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
    #frmPost label.error{
      color: red;
    }
  </style>
</head>
<body>

<?php
  global $wpdb;
  // insert data into wp_custom_plugin db table on page refresh
  // $wpdb->insert(
  //   "wp_custom_plugin",
  //   array(
  //     "name"    => "Jack Henry Sadang",
  //     "email"   => "jackhenrysadang22@gmail.com",
  //     "phone"   => "09275245851"
  //   )
  // );

  // $wpdb->query("INSERT INTO wp_custom_plugin (name, email, phone) VALUES ('Jack Henry Sadang', 'jackhenrysadang22@gmail.com', '09275245851')");

  $wpdb->query(
    $wpdb->prepare(
      "INSERT INTO wp_custom_plugin (name, email, phone) VALUES ('%s', '%s', '%s')",
      "Jack Henry Sadang", "jackhenrysadang22@gmail.com", "092342523"
    )
  )

?>

  <div class="container">
    <form action="" id="frmPost">
      <div class="form-group">
        <label for="txtName">Name:</label>
        <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Enter Name" required>
      </div>
      <div class="form-group">
        <label for="txtEmail">Email:</label>
        <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Enter Email" required>
      </div>
      <div class="form-group form-check">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox"> Remember me
        </label>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</body>
</html>





<!-- <script
  src="http://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
<p>
  <button class="btnClick">Click Me</button>
</p> -->

<!-- <link rel="stylesheet" href="<?php // echo PLUGIN_DIR_URL.'/assets/css/style.css'; ?>">
<script src="<?php // echo PLUGIN_DIR_URL.'/assets/js/script.js'; ?>"></script>
<?php
//  echo "Add New Page";
?>

<h1>Professional WordPress Developer</h1>
<h2>Hello World!</h2>
<img src="<?php // echo PLUGIN_DIR_URL.'/assets/img/professional-wp.jpg'; ?>" alt="Professional WordPress Developer"> -->