<?php
  require_once('lib/print.php');
  require_once('lib/set_button.php');
  session_start();
  $_SESSION['direct6000'] = '1';
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php print_title(); ?></title>
    <link rel="stylesheet" href="css/basic.css?v={{ time() }}">
    <style media="screen">
      #admin{
        display: inline-block;
        margin-left: 90%
      }
    </style>
  </head>
  <body>
    <div id="admin">
      <?php
      if(isset($_SESSION['login_id'])){
        if($_SESSION['login_id'] == 'admin'){
        set_button_author_and_topic('author');
        }
        set_button_CUD();
      }
      print_user_info();
      set_button_login();
      ?>
    </div>
    <div id="Upstairs">
      <img id="logo" src="src/logo.png" width="100px" onclick="location.href='6000.php'">
      <div id="mainlist">
        <?php print_kategory(); ?>
      </div>
    </div>
    <div id="Downstairs">
      <ul id="detaillist">
        <?php print_list(); ?>
      </ul>
      <div id="description">
        <?php print_article(); ?>
      </div>
    </div>
    <a href="admin.php?state=0"><img src="src/login.png" width="3px" style="display: block; margin-left: auto;"></a>
  </body>
</html>
