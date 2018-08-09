<?php
require_once('admin_mysql_info.php');
settype($_POST['id'], 'integer');
settype($_POST['kategory_id'], 'integer');
settype($_POST['author_id'], 'integer');
$filtered = array(
  'id' => mysqli_real_escape_string($con, $_POST['id']),
  'kategory_id' => mysqli_real_escape_string($con, $_POST['kategory_id']),
  'detail_list_title' => trim(mysqli_real_escape_string($con, $_POST['detail_list_title'])),
  'main_title' => trim(mysqli_real_escape_string($con, $_POST['main_title'])),
  'description' => mysqli_real_escape_string($con, $_POST['description']),
  'author_id' => mysqli_real_escape_string($con, $_POST['author_id'])
);
if(empty($filtered['detail_list_title'])){
  $filtered['detail_list_title'] = date("Y-m-d H:i:s");
}
if(empty($filtered['main_title'])){
  $filtered['main_title'] = date("Y-m-d H:i:s").'에 작성된 글';
}
$sql = "UPDATE topic
          SET
            list_title = '{$filtered['detail_list_title']}',
            title = '{$filtered['main_title']}',
            description = '{$filtered['description']}',
            created = NOW(),
            author_id = {$filtered['author_id']},
            kategory_id = {$filtered['kategory_id']}
          WHERE
            id = {$filtered['id']}
";
$result = mysqli_query($con, $sql);
if($result === false){
  echo "글 생성 과정에서 문제가 생겼습니다. 관리자에게 문의해주십시오.
    <a href=\"../6000.php\">돌아가기</a>";
  print(mysqli_error($con));
}else{
  header("Location: ../6000.php?main={$filtered['kategory_id']}&detail={$filtered['id']}");
}

?>
