<?php
require "./functions/init.php"
?>
<?php

if (isset($_GET['name'])) {

 if ($_GET['name'] == "fucker") {

  $update_query = "UPDATE message SET status = 1 WHERE status = 0 ";
  $res = query($update_query);
 }
}

if (isset($_GET['same'])) {

 if ($_GET['same'] == "sucker") {

  $update_query = "UPDATE appointment SET notify = 1 WHERE notify = 0 ";
  $res = query($update_query);
 }
}
