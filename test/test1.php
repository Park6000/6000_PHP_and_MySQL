<?php
$con = mysqli_connect("localhost","root","qkrdbcjs1212","web_6000");
$query = "select * from recommended";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
var_dump($row);
//파일용량설정
$fsize = "524288";
?>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<hr>
<h1>관리자 페이지</h1>
<form method="post" action="upload.php" enctype="multipart/form-data">
<table border=1>
<tr>
  <td colspan=5>
  <input type="hidden" name="MAX_FILE_SIZE" value="<?=$fsize?>">
  파일 용량 제한 : <?=$fsize?>KB
  <input type="file" name="upload"><br>
  </td>
</tr>
<tr>
  <th>이미지</th>
  <th>이름</th>
  <th>프로필</th>
  <th>이미지경로</th>
</tr>
<tr>
  <td><center><img src="<?=$row['img_path']?>"></center></td>
  <td><input type="text" name="name" value="<?=$row['name']?>"></td>
  <td><input type="text" name="profile" value="<?=$row['profile']?>"></td>
  <td><?=$row['img_path']?></td>
</tr>
<tr>
  <th colspan=5><input type="submit" value="업로드"></th>
</tr>
</table>
</form>
