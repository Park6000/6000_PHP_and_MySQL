<?php
function set_button_CUD(){
  echo "<form action=\"page_create.php\" method=\"post\">
          <input type=\"submit\" name=\"create\" value=\"글 생성\">
        </form>";
  if(isset($_GET['kategory']) and isset($_GET['id'])){
    echo "
      <form action=\"page_update.php\" method=\"post\">
        <input type=\"hidden\" name=\"kategory_id\" value={$_GET['kategory']}>
        <input type=\"hidden\" name=\"id\" value={$_GET['id']}>
        <input type=\"submit\" name=\"update\" value=\"글 수정\">
      </form>
      <form action=\"lib/process_delete.php\" method=\"post\"
      onsubmit=\"if(!confirm('이 글을 삭제하시겠습니까?')){return false;}\">
        <input type=\"hidden\" name=\"kategory_id\" value={$_GET['kategory']}>
        <input type=\"hidden\" name=\"id\" value={$_GET['id']}>
        <input type=\"submit\" name=\"delete\" value=\"글 삭제\">
      </form>
    ";
  }
}
function set_button_author_and_topic($go){
  if($go == 'author'){
    echo "<form action=\"author.php\">
            <input type=\"submit\" value=\"작성자 관리 페이지\">
          </form>";
  }elseif($go == 'topic'){
    echo "<form action=\"6000.php\">
            <input type=\"submit\" value=\"토픽 페이지\">
          </form>
          <form action=\"author.php\">
            <input type=\"submit\" value=\"↺\">
          </form>
          ";
  }
}
function set_button_login(){
  if(isset($_SESSION['login_id'])){
      echo "<form action=\"lib/process_logout.php\">
              <input type=\"submit\" value=\"로그아웃\">
            </form>";
  }else{
    echo "<form action=\"page_login.html\">
            <input type=\"submit\" value=\"로그인\">
          </form>";
  }
}
 ?>
