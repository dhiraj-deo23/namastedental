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
     <a href="facilities.php" class="btn btn-info btn-block mb-4 mt-0">BACK</a>

     <?php
     if (isset($_POST['update-submit'])) {
      if (!empty($_POST['info-input']) && !empty($_POST['title-input'])) {
       $title_new = escape(clean($_POST['title-input']));
       $detail_new = escape(clean($_POST['detail-input']));
       $info_new = escape(clean($_POST['info-input']));
       $image = $_FILES['image-input']['tmp_name'];
       $name = basename($_FILES['image-input']['name']);
       move_uploaded_file($image, "../images/$name");
       $id = $_GET['edit'];
       $sql = "UPDATE facilities SET image = '{$name}', heading = '{$title_new}', content = '{$info_new}', description = '$detail_new' where id = $id ";
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
      $sql = "DELETE FROM facilities WHERE id = $id ";
      $res = query($sql);
      redirect("facilities.php");
     }
     ?>
     <?php
     if (isset($_GET['edit'])) {
      $id = $_GET['edit'];
      $sql = "SELECT * FROM facilities where id = $id ";
      $res = query($sql);
      $row = mysqli_fetch_assoc($res);
      $title = $row['heading'];
      $info = $row['content'];
      $detail = $row['description'];
      $image = $row['image'];
     ?>
      <div class="row">
       <div class="col-md-12 col-sm-12">
        <div class="card">
         <div class="card-header">
          <strong>Change Facilities</strong>
         </div>
         <div class="card-body card-block">
          <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
           <div class="row form-group">
            <div class="col col-md-3">
             <label for="text-input" class=" form-control-label">Enter the Title of the Facility</label>
            </div>
            <div class="col-12 col-md-9">
             <input type="text" name="title-input" value="<?php echo $title  ?>" placeholder="Title" class="form-control">
            </div>
           </div>
           <div class="row form-group">
            <div class="col col-md-3">
             <label for="image" class="form-control-label">Upload an image</label>
             <img width="20" height="10" src="../images/<?php echo $image; ?>" alt="">
            </div>
            <div class="col-12 col-md-9">
             <input type="file" name="image-input" class="form-control">
            </div>
           </div>
           <div class="row form-group">
            <div class="col col-md-3">
             <label for="info-input" class=" form-control-label">Details of Facility</label>
            </div>
            <div class="col-12 col-md-9">
             <textarea type="text" name="info-input" placeholder="Facility Info" class="form-control"><?php echo $info ?></textarea>
            </div>
           </div>
           <div class="row form-group">
            <div class="col col-md-3">
             <label for="detail-input" class=" form-control-label">Descriptive Detail</label>
            </div>
            <div class="col-12 col-md-9">
             <textarea type="text" name="detail-input" placeholder="Details of Facility" class="form-control"><?php echo $detail ?></textarea>
            </div>
           </div>
           <div class="card-footer">
            <button type="submit" class="btn btn-primary btn-sm" name="update-submit">
             <i class="fa fa-dot-circle-o"></i> Submit
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