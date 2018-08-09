<?php
function login_form(){
    echo "
    <form  action=\"admin/login_process.php\" method=\"post\">
      <input type=\"text\" name=\"id\" placeholder=\"ID\">
      <input type=\"text\" name=\"password\" placeholder=\"PASSWORD\">
      <input type=\"submit\" value=\"Login\">
    </form>
    ";
}
function logout_form(){
    echo "<input type=\"button\" value=\"Logout\" onclick=\"location.href='address'\">";

}
function login_state(){
  if ($_GET['state'] == 0) {
    return 0;
  }elseif ($_GET['state'] == 1 and $_GET['code'] == 'KNU2018') {
    return 1;
  }
}
function login_or_logout(){
  if (login_state() == 1) {
    login_form();
  }
}
?>
