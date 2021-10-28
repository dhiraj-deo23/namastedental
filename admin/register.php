<?php include "./includes/header.php" ?>
<?php
if (!logged_in()) {
 redirect("login.php");
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
        <label>Full Name</label>
        <input class="au-input au-input--full" type="text" name="fullname" placeholder="Full Name" required>
       </div>

       <div class="form-group">
        <label>Username</label>
        <input class="au-input au-input--full" type="text" name="username" placeholder="Username" required>
       </div>
       <div class="form-group">
        <label>Email Address</label>
        <input class="au-input au-input--full" type="email" name="email" placeholder="Email" required>
       </div>
       <div class="form-group">
        <label>Password</label>
        <input class="au-input au-input--full" type="password" name="password" placeholder="Password" required>
       </div>

       <button class="au-btn au-btn--block au-btn--green m-b-20" name="register-submit" type="submit">register</button>
      </form>


      <?php
      if (isset($_POST['register-submit'])) {
       $fullname = clean($_POST['fullname']);
       $username = clean($_POST['username']);
       $email = clean($_POST['email']);
       $password = clean($_POST['password']);

       if (!empty($fullname) && !empty($username) && !empty($email) && !empty($password)) {
        register_user($fullname, $username, $email, $password);
       } else {
        echo "required fields can't be empty";
       }
      }

      ?>

     </div>
    </div>
   </div>
  </div>
 </div>

</div>

<?php include "./includes/footer.php" ?>