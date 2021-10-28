<?php
require "./functions/init.php"
?>
<?php
if (!logged_in()) {
 redirect("login.php");
}
?>

  <?php
  if (isset($_GET['delete'])) {
   $id = $_GET['delete'];
   $sql = "DELETE FROM announcements WHERE id = $id ";
   $res = query($sql);
   redirect("setting.php");
  }
  ?>
  <?php
  if (isset($_GET['publish'])) {
   $id = $_GET['publish'];
   $sql = "UPDATE announcements SET active = 0 WHERE id != $id ";
   $res = query($sql);
   $sql2 = "UPDATE announcements SET active = 1 WHERE id = $id ";
   $res2 = query($sql2);
   redirect("setting.php");
  }
  ?>
  <?php
  if (isset($_GET['del_job'])) {
   $id = $_GET['del_job'];
   $sql = "DELETE FROM jobs WHERE id = $id ";
   $res = query($sql);
   redirect("setting.php");
  }
  ?>
  <?php
  if (isset($_GET['pub_job'])) {
   $id = $_GET['pub_job'];
   $sql = "UPDATE jobs SET active = 0 WHERE id != $id ";
   $res = query($sql);
   $sql2 = "UPDATE jobs SET active = 1 WHERE id = $id ";
   $res2 = query($sql2);
   redirect("setting.php");
  }
  ?>
  <?php
  if (isset($_GET['unpublish'])) {
   $id = $_GET['unpublish'];
   $sql = "UPDATE jobs SET active = 0 WHERE id = $id ";
   $res = query($sql);
   redirect("setting.php");
  }
  ?>

