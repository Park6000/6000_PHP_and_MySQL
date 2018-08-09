<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="index.html" method="post">
      <p>카테고리 생성</p>
      <?php
        $sql = "
          CREATE TABLE `topic_1` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `list_title` varchar(15) NOT NULL,
          `title` varchar(30) NOT NULL,
          `description` text,
          `created` datetime NOT NULL,
          `author_id` int(11) NOT NULL,
          `kategory_id` int(11) NOT NULL,
          PRIMARY KEY (`id`)
          ) ENGINE=InnoDB
        ";
      ?>
    </form>
  </body>
</html>
