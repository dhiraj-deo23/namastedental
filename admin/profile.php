<?php include "./includes/header.php" ?>
<?php
if (!logged_in()) {
 redirect("login.php");
}
?>
<div class="page-wrapper">
 <!-- HEADER MOBILE-->
 <header class="header-mobile d-block d-lg-none">
  <div class="header-mobile__bar">
   <div class="container-fluid">
    <div class="header-mobile-inner">
     <a class="logo" href="index.html">
      <img src="images/icon/logo.png" alt="CoolAdmin" />
     </a>
     <button class="hamburger hamburger--slider" type="button">
      <span class="hamburger-box">
       <span class="hamburger-inner"></span>
      </span>
     </button>
    </div>
   </div>
  </div>
  <?php include "./includes/nav.php" ?>

 </header>
 <!-- END HEADER MOBILE-->

 <!-- MENU SIDEBAR-->
 <?php include "./includes/side-nav.php" ?>

 <!-- END MENU SIDEBAR-->

 <!-- PAGE CONTAINER-->
 <div class="page-container">
  <!-- HEADER DESKTOP-->
  <?php include "./includes/top-nav.php" ?>

  <!-- END HEADER DESKTOP-->

  <!-- MAIN CONTENT-->
  <div class="main-content">
   <div class="section__content section__content--p30">
    <div class="container-fluid">
     <div class="row">
      <?php
      $email = $_SESSION['email'];
      $sql = "SELECT * FROM users where email = '$email' ";
      $res = query($sql);
      $row = mysqli_fetch_assoc($res);
      $name = $row['fullname'];
      $username = $row['username'];
      $sql2 = "SELECT * FROM team where email = '$email' ";
      $res2 = query($sql2);
      $row2 = mysqli_fetch_assoc($res2);
      $image = $row2['image'];
      ?>
      <div class="card text-white bg-primary">
       <div class="row  align-items-center">

        <div class="col-lg-6 col-md-6">
         <img class="card-img-top" src="../images/<?php echo $image ?>" alt="">
        </div>
        <div class="col-lg-6 col-md-6">
         <h3 class="text-white">Name: <span>Dr. <?php echo $name ?></span></h3><br><br>
         <h3 class="text-white">Username: <span><?php echo $username ?></span></h3><br><br>
         <h3 class="text-white">Email: <span><?php echo $email ?></span></h3><br><br>
        </div>
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-lg-12 col-md-12">
       <a href="reset-pass.php"><i class="zmdi zmdi-settings"></i> Change your password</a>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>

<?php include "./includes/footer.php" ?>