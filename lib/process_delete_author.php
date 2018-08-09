<?php
require_once('admin_mysql_info.php');
settype($_POST['id'], 'integer');
$filtered = array(
  'id' => mysqli_real_escape_string($con, $_POST['id']),
);
// topic 삭제
$sql = "
  DELETE
    FROM topic
    WHERE
      author_id = {$filtered['id']}
";
mysqli_query($con, $sql);
// author 삭제
$sql = "
  DELETE
    FROM author
    WHERE
      id = {$filtered['id']}
";
$result = mysqli_query($con, $sql);
if($result === false){
  echo "작성자 삭제 과정에서 문제가 생겼습니다. 관리자에게 문의해주십시오.
    <a href=\"../author.php\">돌아가기</a>";
   error_log(mysqli_error($con));
}else {
  header('Location: ../author.php');
}
?>
