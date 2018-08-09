<?php
require_once('admin_mysql_info.php');
settype($_POST['id'], 'integer');
$filtered = array(
  'id' => mysqli_real_escape_string($con, $_POST['id']),
  'name' => trim(mysqli_real_escape_string($con, $_POST['name'])),
  'profile' => trim(mysqli_real_escape_string($con, $_POST['profile'])),
);
$sql = "UPDATE author
          SET
            name = '{$filtered['name']}',
            profile = '{$filtered['profile']}'
          WHERE
            id = {$filtered['id']}
";
if(empty($filtered['name'])){
  echo "이름이 비어있습니다. 다시 작성해주십시오.
    <a href=\"../author.php\">돌아가기</a>";
}else{
  $result = mysqli_query($con, $sql);
  if($result === false){
    echo "작성자 수정 과정에서 문제가 생겼습니다. 관리자에게 문의해주십시오.
      <a href=\"../author.php\">돌아가기</a>";
    print(mysqli_error($con));
  }else{
    header("Location: ../author.php");
  }
}
?>
