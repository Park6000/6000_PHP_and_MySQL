<?php require_once('lib/print.php'); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Profile</title>
    <style>
      #profile_text *{
        margin: auto;
        text-align: center;
        text-align-last: center;
      }
    </style>
  </head>
  <body>
    <img id="logo" src="src/logo.png" width="150px" onclick="location.href='6000.php'"
    style="margin: 30px auto 30px auto; display: block;">
    <div id="profile_text">
      <?php print_profile(); ?>
    </div>
  </body>
</html>
