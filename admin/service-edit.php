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

  <!-- HEADER DESKTOP-->

  <!-- MAIN CONTENT-->
  <div class="main-content">
   <div class="section__content section__content--p30">
    <div class="container-fluid">
     <a href="services.php" class="btn btn-info btn-block mb-4 mt-0">BACK</a>

     <?php
     if (isset($_POST['update-submit'])) {
      if (!empty($_POST['icon-input']) && !empty($_POST['info-input']) && !empty($_POST['title-input'])) {
       $title_new = escape(clean($_POST['title-input']));
       $icon_new = escape(clean($_POST['icon-input']));
       $info_new = escape(clean($_POST['info-input']));
       $id = $_GET['edit'];
       $sql = "UPDATE services SET icon = '{$icon_new}', title = '{$title_new}', info = '{$info_new}' where id = $id ";
       $res = mysqli_query($connection, $sql);
       if (!$res) {
        echo mysqli_error($connection);
       }
      }
     }
     ?>

     <?php
     if (isset($_GET['delete'])) {
      $id = $_GET['delete'];
      $sql = "DELETE FROM services WHERE id = $id ";
      $res = query($sql);
      redirect("services.php");
     }
     ?>
     <?php
     if (isset($_GET['edit'])) {
      $id = $_GET['edit'];
      $sql = "SELECT * FROM services where id = $id ";
      $res = query($sql);
      $row = mysqli_fetch_assoc($res);
      $title = $row['title'];
      $info = $row['info'];
      $icon = $row['icon'];
     ?>
      <div class="row">
       <div class="col-md-12 col-sm-12">
        <div class="card">
         <div class="card-header">
          <strong>Change Services</strong>
         </div>
         <div class="card-body card-block">
          <form action="" method="POST" class="form-horizontal">

           <div class="row form-group">
            <div class="col col-md-3">
             <label for="text-input" class=" form-control-label">Enter the Title for the service</label>
            </div>
            <div class="col-12 col-md-9">
             <input type="text" value="<?php echo $title ?>" name="title-input" placeholder="Title" class="form-control">
            </div>
           </div>
           <div class="row form-group">
            <div class="col col-md-3">
             <label for="email-input" class=" form-control-label">The icon for the Service</label>
            </div>
            <div class="col-12 col-md-9">
             <input type="text" value="<?php echo $icon ?>" name="icon-input" placeholder="Font Awesome Icon" class="form-control">
            </div>
           </div>
           <div class="row form-group">
            <div class="col col-md-3">
             <label for="info-input" class=" form-control-label">Details of Service</label>
            </div>
            <div class="col-12 col-md-9">
             <textarea type="text" name="info-input" placeholder="Service Info" class="form-control"><?php echo $info ?></textarea>
            </div>
           </div>
           <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm" name="update-submit">
             <i class="fa fa-dot-circle-o"></i> Update
            </button>
           </div>
          </form>

         </div>
        </div>
       </div>
      </div>
     <?php
     }
     ?>
    </div>
   </div>
  </div>

 </div>

 <?php include "./includes/footer.php" ?>