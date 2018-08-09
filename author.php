<?php
require_once('lib/print.php');
require_once('lib/admin_button.php');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>author</title>
  </head>
  <body>
    <?php set_button_author_and_topic('topic'); ?>
    <table border="1">
      <thead>
        <tr>
          <th>id</th>
          <th>name</th>
          <th>profile</th>
          <th>created</th>
        </tr>
      </thead>
      <tbody>
        <?php print_author(); ?>
      </tbody>
    </table>
    <?php
    $filtered = array(
      'name' => '',
      'profile' => ''
    );
    $label_submit = '생성';
    $form_action = 'lib/process_create_author.php';
    $form_id = '';
    if(isset($_POST['id'])){
      $filtered_id = mysqli_real_escape_string($con, $_POST['id']);
      settype($filtered_id, 'integer');
      $sql = "SELECT * FROM author WHERE id = {$filtered_id}";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result);
      $filtered['name'] = htmlspecialchars($row['name']);
      $filtered['profile'] = htmlspecialchars($row['profile']);
      $label_submit = '수정';
      $form_action = 'lib/process_update_author.php';
      $form_id = '<input type="hidden" name="id" value="'.$filtered_id.'">';
    }
    ?>
    <form action="<?=$form_action?>" method="post">
      <?=$form_id?>
      <p><input type="text" name="name" placeholder="이름" value="<?=$filtered['name']?>"></p>
      <p><textarea name="profile" rows="8" cols="80" placeholder="프로필"><?=$filtered['profile']?></textarea></p>
      <p><input type="submit" value="<?=$label_submit?>"></p>
    </form>
  </body>
</html>
