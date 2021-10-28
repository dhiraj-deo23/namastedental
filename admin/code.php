<?php include "./includes/header.php" ?>

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
        <label>Enter the Code</label>
        <input class="au-input au-input--full" type="number" name="code" placeholder="code">
       </div>
       <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="submit">submit</button>
      </form>
      <?php
      unset($_COOKIE['code']);
      setcookie('code', '', time() - 60 * 60 * 24 * 3);

      validate_code();

      ?>
     </div>
    </div>
   </div>
  </div>
 </div>

</div>

<?php include "./includes/footer.php" ?>