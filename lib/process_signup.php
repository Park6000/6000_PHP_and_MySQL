<?php  //수정완료 2018.08.09
require_once('admin_mysql_info.php');
$id=mysqli_real_escape_string($con, trim($_POST['id']));
$nickname=mysqli_real_escape_string($con, trim($_POST['nickname']));
$pw=mysqli_real_escape_string($con, $_POST['pw']);
$pwc=mysqli_real_escape_string($con, $_POST['pwc']);
$name=mysqli_real_escape_string($con, trim($_POST['name']));
$email=mysqli_real_escape_string($con, trim($_POST['email']));

if($pw!=$pwc)  //비밀번호와 비밀번호 확인 문자열이 맞지 않을 경우
{
    echo "비밀번호와 비밀번호 확인이 서로 다릅니다. ";
    echo "<a href='../page_signup.html'>돌아가기</a>";
    exit();
}
if($id==NULL || $pw==NULL || $name==NULL || $email==NULL) //
{
    echo "빈 칸을 모두 채워주세요. ";
    echo "<a href='../page_signup.html'>돌아가기</a>";
    exit();
}

$check="SELECT *from login WHERE user_id='$id'";
$result=$con->query($check);
if($result->num_rows==1)
{
    echo "중복된 아이디입니다. ";
    echo "<a href='../page_signup.html'>돌아가기</a>";
    exit();
}

$signup=mysqli_query($con,"INSERT INTO login (user_id,user_password,user_name,user_email,created)
  VALUES ('$id','$pw','$name','$email',NOW())");
if($signup){
  $sql = "SELECT * FROM login WHERE user_id=\"{$id}\"";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($result);
  $profileup = mysqli_query($con,"INSERT INTO author (nickname, login_id)
    VALUES ('{$nickname}', {$row['id']})");
    if($profileup){
      echo "회원가입을 축하합니다. ";
      echo "<a href='../6000.php'>돌아가기</a>";
    }
}
?>
