<?php include "./includes/header.php" ?>

<?php
session_destroy();
if (isset($_COOKIE['email'])) {
 unset($_COOKIE['email']);
 setcookie('email', '', time() - 60 * 60 * 24);
}


redirect("login.php");
?>
<?php include "./includes/footer.php" ?>