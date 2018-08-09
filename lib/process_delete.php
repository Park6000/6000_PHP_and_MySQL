<?php
require_once('admin_mysql_info.php');
settype($_POST['main_list'], 'integer');
settype($_POST['detail_list'], 'integer');
var_dump($_POST);
$filtered = array(
  'kategory_id' => mysqli_real_escape_string($con, $_POST['main_list']),
  'id' => mysqli_real_escape_string($con, $_POST['detail_list'])
);

$sql = "
  DELETE
    FROM topic
    WHERE
      id = {$filtered['id']}
";
$result = mysqli_query($con, $sql);
if($result === false){
  echo "글 생성 과정에서 문제가 생겼습니다. 관리자에게 문의해주십시오.
    <a href=\"../6000.php\">돌아가기</a>";
  print(mysqli_error($con));
}else{
  header("Location: ../6000.php?main={$filtered['kategory_id']}");
}
?>
