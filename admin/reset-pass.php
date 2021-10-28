<?php include "./includes/header.php" ?>
<?php
if (!isset($_SESSION['secure']) && !logged_in()) {
 redirect("../index.php");
}

?>
<div class="page-wrapper">
 <div class="page-content--bge5">
  <div class="container">
   <div class="login-wrap">
    <div class="login-content">
     <div class="login-logo">
      <a href="#">
       <img src="images/icon/logo.png" alt="CoolAdmin">
      </a>
     </div>
     <div class="login-form">
      <form action="" method="post">
       <div class="form-group">
        <label>Enter New Password</label>
        <input class="au-input au-input--full" type="password" name="password" placeholder="Password">
       </div>
       <div class="form-group">
        <label>Confirm New Password</label>
        <input class="au-input au-input--full" type="password" name="c-password" placeholder="Password">
       </div>
       <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="recov-submit">submit</button>
      </form>
      <?php
      recover_password();
      ?>
     </div>
    </div>
   </div>
  </div>

 </div>
 <?php include "./includes/footer.php" ?>