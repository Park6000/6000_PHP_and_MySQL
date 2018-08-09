<?php
require_once('client_mysql_info.php');
session_start();
$id=mysqli_real_escape_string($con, trim($_POST['id']));
$pw=mysqli_real_escape_string($con, $_POST['pw']);

$check="SELECT id, user_id, user_password FROM login WHERE user_id='{$id}'";
$result=$con->query($check);
if($result->num_rows==1){
    $row=$result->fetch_array(MYSQLI_ASSOC); //하나의 열을 배열로 가져오기
    if($row['user_password']==$pw){  //MYSQLI_ASSOC 필드명으로 첨자 가능
        $_SESSION['login_id']=$row['id'];          //로그인 성공 시 세션 변수 만들기
        if(isset($_SESSION['login_id']))    //세션 변수가 참일 때
        {
            header('Location: ../6000.php');   //로그인 성공 시 페이지 이동
        }else{
            echo "세션 저장 실패 ";
            echo "<a href=\"../page_login.html\">돌아가기</a>";
        }
    }else{
        echo "아이디 또는 비밀번호가 틀렸습니다. ";
        echo "<a href=\"../page_login.html\">돌아가기</a>";
    }
}else{
    echo "아이디 또는 비밀번호가 틀렸습니다. ";
    echo "<a href=\"../page_login.html\">돌아가기</a>";
}
?>
