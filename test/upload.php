<?php
$con = mysqli_connect("localhost","root","qkrdbcjs1212","web_6000");
//짧은변수
$name = $_POST['name'];
$profile = $_POST['profile'];
$path = "/uploads/".$_FILES['upload']['name'];
//업로드된 파일의 존재여부 에러가 없다면
if(isset($_FILES['upload']) && !$_FILES['upload']['error'])
{
  //허용할 이미지 종류를 배열로 저장
  $imageKind = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
  //imageKind 배열내에 $_FILES['upload']['type']에 해당되는 타입(문자열) 있는지 체크
  if(in_array($_FILES['upload']['type'], $imageKind))
  {
    if(move_uploaded_file($_FILES['upload']['tmp_name'], "./uploads/{$_FILES['upload']['name']}"))
    {;
      $query = "update recommended set name='$name', profile='$profile', img_path='$path' where idx=1";
      $db->query($query);
      echo ("<script>location.replace('./');</script>");
    }
  }
  else
  {
    echo "이미지 타입 에러";
  }
}
else
{
  echo "업로드 실패";
}
?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<br><a href = './'>처음으로</a>
