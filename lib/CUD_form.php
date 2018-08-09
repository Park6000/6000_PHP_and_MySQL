<?php
require_once('lib/client_mysql_info.php');
function form_create(){
  global $con;
  echo '<form id="form_create" action="lib/process_create.php" method="post">
          <select name="kategory_id">';
          $sql = "SELECT * FROM kategory";
          $result = mysqli_query($con, $sql);
          var_dump($result);
          while($row = mysqli_fetch_array($result)){
            $filtered_title = htmlspecialchars($row['title']);
            echo "<option value=\"{$row['id']}\">{$filtered_title}</option>";
          }
  echo   '</select>
          <p><input type="text" name="title" placeholder="메인 제목"></p>
          <p><textarea name="description" rows="8" cols="80" placeholder="본문 내용"></textarea></p>';
          $sql = "SELECT nickname FROM author WHERE login_id = {$_SESSION['login_id']}";
          $result = mysqli_query($con, $sql);
          $row = mysqli_fetch_array($result);
          $filtered_name = htmlspecialchars($row['nickname']);
  echo    '<p>by '.$filtered_name.'</p>
          <p><input type="submit" value="작성"></p>
        </form>';
}
function form_update(){
  global $con;
  $filtered = array(
    'kategory_id' => mysqli_real_escape_string($con, $_POST['main_list']),
    'detail' => mysqli_real_escape_string($con, $_POST['detail_list'])
  );
  $sql = "SELECT * FROM topic WHERE id={$filtered['detail']}";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $filtered['list_title'] = htmlspecialchars($row['list_title']);
  $filtered['title'] = htmlspecialchars($row['title']);
  $filtered['description'] = htmlspecialchars($row['description']);
  $filtered['author_id'] = htmlspecialchars($row['author_id']);
  echo '<form id="form_update" action="lib/process_update.php" method="post">
          <input type="hidden" name="id" value="'.$filtered['detail'].'">
          <select name="kategory_id">';
          $sql = "SELECT * FROM kategory";
          $result = mysqli_query($con, $sql);
          var_dump($result);
          while($row = mysqli_fetch_array($result)){
            $filtered_name = htmlspecialchars($row['name']);
            if($filtered['kategory_id']===$row['id']){
              echo "<option selected value=\"{$row['id']}\">{$filtered_name}</option>";
            }else{
              echo "<option value=\"{$row['id']}\">{$filtered_name}</option>";
            }
          }
  echo   '</select>
          <p><input type="text" name="detail_list_title" placeholder="리스트 제목(짧은 제목)" value="'.$filtered['list_title'].'"></p>
          <p><input type="text" name="main_title" placeholder="메인 제목" value="'.$filtered['title'].'"></p>
          <p><textarea name="description" rows="8" cols="80" placeholder="본문 내용">'.$filtered['description'].'</textarea></p>
          <select name="author_id">';
          $sql = 'SELECT * FROM author';
          $result = mysqli_query($con, $sql);
          while($row = mysqli_fetch_array($result)){
            $filtered_name = htmlspecialchars($row['name']);
            if ($filtered['author_id'] === $row['id']) {
              echo "<option selected value=\"{$row['id']}\">{$filtered_name}</option>";
            }else{
              echo "<option value=\"{$row['id']}\">{$filtered_name}</option>";
            }
          }
  echo   '</select>
          <p><input type="submit" value="작성"></p>
        </form>';
}

?>
