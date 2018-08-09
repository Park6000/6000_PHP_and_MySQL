<?php
require_once('client_mysql_info.php');
session_start();
settype($_POST['kategory_id'], 'integer');
settype($_POST['author_id'], 'integer');
$filtered = array(
  'kategory_id' => mysqli_real_escape_string($con, $_POST['kategory_id']),
  'title' => trim(mysqli_real_escape_string($con, $_POST['title'])),
  'description' => mysqli_real_escape_string($con, $_POST['description']),
  'login_id' => mysqli_real_escape_string($con, $_SESSION['login_id'])
);
if(empty($filtered['detail_list_title'])){
  $filtered['detail_list_title'] = date("Y-m-d");
}
if(empty($filtered['main_title'])){
  $filtered['main_title'] = date("Y-m-d H:i:s").'에 작성된 글';
}
$sql = "INSERT
          INTO
            `6000`.`topic`
            (`title`, `description`, `created`,`login_id`, `kategory_id`)
          VALUES(
            '{$filtered['title']}',
            '{$filtered['description']}',
            NOW(),
            {$filtered['login_id']},
            {$filtered['kategory_id']}
          )";

$result = mysqli_query($con, $sql);
if($result === false){
  echo "글 생성 과정에서 문제가 생겼습니다. 관리자에게 문의해주십시오.
    <a href=\"../6000.php\">돌아가기</a>";
  print(mysqli_error($con));
}else{
  header("Location: ../6000.php?kategory={$filtered['kategory_id']}");
}

?>
