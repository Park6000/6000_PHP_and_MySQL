<?php
require_once('admin_mysql_info.php');
$filtered = array(
  'name' => trim(mysqli_real_escape_string($con, $_POST['name'])),
  'profile' => trim(mysqli_real_escape_string($con, $_POST['profile'])),
);
$sql = "
  INSERT INTO author
    (name, profile, created)
    VALUES(
      '{$filtered['name']}',
      '{$filtered['profile']}',
      NOW()
    )
";

if(empty($filtered['name'])){
  echo "이름이 비어있습니다. 다시 작성해주십시오.
    <a href=\"../author.php\">돌아가기</a>";
}else{
  $result = mysqli_query($con, $sql);
  if($result === false){
    echo "작성자 생성 과정에서 문제가 생겼습니다. 관리자에게 문의해주십시오.
      <a href=\"../author.php\">돌아가기</a>";
    print(mysqli_error($con));
  }else{
    header("Location: ../author.php");
  }
}
?>
