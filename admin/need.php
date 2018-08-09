<?php
  require_once('admin/login.php');
  require_once('admin/form.php');

  function need(){
    if (login_state()==1 and isset($_GET['need'])){
      if($_GET['need']=='upload'){
        need_upload();
      }elseif ($_GET['need']=='update') {
        need_update();
      }elseif ($_GET['need']=='delete') {
        need_delete();
      }
    }
  }

  function need_upload(){
    form_upload();
  }
  function need_update(){
    $list = scandir('./list');
    $i = 0;
    echo "<select name='mainlist' size='4'>";
    while($i < count($list)){
      $title = htmlspecialchars($list[$i]);
      if($list[$i] != '.' and $list[$i] !='..'){
        echo "<option value=".$list[$i].">".$list[$i]."</option>";
      }
      $i = $i + 1;
    }
    echo "</select>";

    form_update();
  }
  function need_delete(){
    form_delete();
  }
 ?>
