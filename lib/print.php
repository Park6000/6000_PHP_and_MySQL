<?php
require_once('client_mysql_info.php');
//수정완료 2018.08.09
function print_user_info(){
  global $con;
  if(isset($_SESSION['login_id'])){
    $login_id = $_SESSION['login_id'];
    $sql = "SELECT nickname FROM author WHERE login_id = {$login_id}";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $filtered_nickname = htmlspecialchars($row['nickname']);
    echo $filtered_nickname."님!";
  }
}
//수정완료 2018.08.09
function print_profile(){
  global $con;
  settype($_GET['id'], 'integer');
  $filtered = array(
    'id' => mysqli_real_escape_string($con, $_GET['id'])
  );
  $sql = "SELECT * FROM author WHERE login_id = {$filtered['id']}";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $filtered['nickname'] = htmlspecialchars($row['nickname']);
  $filtered['profile'] = htmlspecialchars($row['profile']);
  echo "
    <h3>{$filtered['nickname']}</h3>
    <p>{$filtered['profile']}<p>
  ";

}
//수정완료 2018.08.09
function print_author(){
  global $con;
  $sql = 'SELECT author.id, nickname, profile, user_name, user_email, created
          FROM author LEFT JOIN login ON author.login_id = login.id';
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)){
    $filtered = array(
      'id' => htmlspecialchars($row['id']),
      'nickname' => htmlspecialchars($row['nickname']),
      'profile' => htmlspecialchars($row['profile']),
      'user_name' => htmlspecialchars($row['user_name']),
      'user_email' => htmlspecialchars($row['user_email']),
      'created' => htmlspecialchars($row['created'])
    );
    echo "<tr>
            <td>{$filtered['id']}</td>
            <td>{$filtered['nickname']}</td>
            <td>{$filtered['profile']}</td>
            <td>{$filtered['user_name']}</td>
            <td>{$filtered['user_email']}</td>
            <td>{$filtered['created']}</td>
            <td>
            <form action=\"author.php\" method=\"post\">
              <input type=\"hidden\" name=\"id\" value=\"{$filtered['id']}\">
              <input type=\"submit\" value=\"수정\">
            </form>
            </td>
            <td>
              <form action=\"lib/process_delete_author.php\" method=\"post\" onsubmit=\"if(!confirm('{$filtered['user_name']}의 계정을 삭제하시겠습니까? 이 경우, 모든 작성글이 삭제됩니다.')){return false;}\">
                <input type=\"hidden\" name=\"id\" value=\"{$filtered['id']}\">
                <input type=\"submit\" value=\"삭제\">
              </form>
            </td>
          </tr>";
  }
  return TRUE;
}
//수정완료 2018.08.09
function print_title(){
  global $con;
  if (isset($_GET['kategory']) and isset($_GET['id'])){
    $filtered = array(
      'id' => mysqli_real_escape_string($con, $_GET['id']),
    );
    $sql = "
      SELECT * FROM topic WHERE topic.id={$filtered['id']}
    ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $filtered['title'] = htmlspecialchars($row['title']);
    echo $filtered['title'];
    return TRUE;
  }elseif (isset($_GET['kategory']) ) {
    $filtered = array(
      'kategory' => mysqli_real_escape_string($con, $_GET['kategory'])
    );
    $sql = "
      SELECT * FROM kategory WHERE id={$filtered['kategory']}
    ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $filtered['title'] = htmlspecialchars($row['title']);
    echo $filtered['title'];
    return TRUE;
  }else {
    echo "6000";
    return TRUE;
  }
}
//수정완료 2018.08.09
function print_article(){
  global $con;
  if (isset($_GET['kategory']) and isset($_GET['id'])){  // kategory_id와 topic_id가 존재
    $filtered = array(
      'kategory' => mysqli_real_escape_string($con, $_GET['kategory']),
      'id' => mysqli_real_escape_string($con, $_GET['id']),
    );
    $sql = "
      SELECT * FROM topic LEFT JOIN author ON topic.login_id = author.login_id WHERE topic.id={$filtered['id']}
    ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $filtered['title'] = htmlspecialchars($row['title']);
    $filtered['description'] = nl2br(htmlspecialchars($row['description']));
    $filtered['nickname'] = htmlspecialchars($row['nickname']);
    $filtered['login_id'] = htmlspecialchars($row['login_id']);
    echo "<h2>{$filtered['title']}</h2>";
    echo "<p>{$filtered['description']}</p>";
    echo "<p>by <a href=\"profile.php?id={$filtered['login_id']}\">{$filtered['nickname']}</a></p>";
    return TRUE;
  }elseif (isset($_GET['kategory']) ) {  // kategory_id가 존재
    $filtered = array(
      'kategory' => mysqli_real_escape_string($con, $_GET['kategory'])
    );
    $sql = "
      SELECT * FROM kategory WHERE id={$filtered['kategory']}
    ";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $filtered['title'] = htmlspecialchars($row['title']);
    $filtered['description'] = nl2br(htmlspecialchars($row['description']));
    echo "<h2>{$filtered['title']}</h2>";
    echo "<p>{$filtered['description']}</p>";
    return TRUE;
  }else {  // 값 없음
    echo "<h2>Welcome</h2>";
    echo "<p>6000에 오신것을 환영합니다.</p>";
    return TRUE;
  }
}
//수정완료 2018.08.09
function print_kategory(){
  global $con;
  $sql = "
    SELECT * FROM kategory
  ";
  $result = mysqli_query($con, $sql);
  while($row = mysqli_fetch_array($result)){
    echo "<p class=\"mainlistelement\"><a href=\"6000.php?kategory={$row['id']}\">{$row['title']}</a></p>\n";
  }
  return TRUE;
}
//수정완료 2018.08.09
function print_list(){
  global $con;
  if (isset($_GET['kategory'])){
    $filtered_kategory_id = mysqli_real_escape_string($con, $_GET['kategory']);
    settype($filtered_kategory_id, 'integer');
    $sql = "
      SELECT * FROM topic WHERE kategory_id = {$filtered_kategory_id}
    ";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_array($result)){
      $filtered = array(
        'kategory_id' => htmlspecialchars($row['kategory_id']),
        'id' => htmlspecialchars($row['id']),
        'title' => htmlspecialchars($row['title'])
      );
      echo "<li class=\"detaillistelement\"><a href=\"6000.php?kategory={$filtered['kategory_id']}&id={$filtered['id']}\">{$filtered['title']}</a></li>\n";
    }
  }
  return TRUE;
}
?>
