<?php
require_once('lib/CUD_form.php');
session_start();
if(!isset($_SESSION['user_id'])){
  header("Location: ../6000.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>update</title>
    <link rel="stylesheet" href="css/CUD_form.css?v=<%=System.currentTimeMillis() %>">
  </head>
  <body>
    <div id="update_form">
      <img id="logo" src="src/logo.png" width="150px" onclick="location.href='6000.php'"
      style="margin: 30px auto 30px auto; display: block;">
      <?php form_update(); ?>
    </div>
  </body>
</html>
