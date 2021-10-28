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
     <div class="row">
      <div class="col-md-12">
       <div class="card">
        <div class="card-header">
         <strong>About details</strong>
        </div>
        <div class="card-body card-block">
         <table class="table table-bordered table-striped table-danger">
          <thead>
           <tr>
            <th>Id</th>
            <th>Image</th>
            <th>Content 1</th>
            <th>Content 2</th>
           </tr>
          </thead>
          <tbody>

           <?php
           $sql = "SELECT * FROM about";
           $res = query($sql);
           $row = mysqli_fetch_assoc($res);
           $content = $row['content'];
           $detail = $row['detail'];
           $image = $row['image'];
           $id = $row['id'];
           echo "<tr>";
           echo "<td>$id</td>";
           echo "<td><img src='../images/$image' alt='about-image'></td>";
           echo "<td>$content</td>";
           echo "<td>$detail</td>";
           echo "</tr>";
           ?>
          </tbody>
         </table>
        </div>
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-md-12 col-sm-12">
       <div class="card">
        <div class="card-header">
         <strong>Edit About section</strong>
        </div>
        <div class="card-body card-block">
         <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="text-input" class=" form-control-label">Enter the Content</label>
           </div>
           <div class="col-12 col-md-9">
            <textarea name="name-input" class="form-control"><?php echo $content ?></textarea>
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="text-input" class=" form-control-label">Enter the Detail</label>
           </div>
           <div class="col-12 col-md-9">
            <textarea name="email-input" class="form-control"><?php echo $detail ?></textarea>
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="image" class="form-control-label">Upload an image</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="file" name="image-input" value="<?php echo $image ?>" class="form-control">
           </div>
          </div>
          <div class="card-footer">
           <button type="submit" class="btn btn-primary btn-sm" name="submit">
            <i class="fa fa-dot-circle-o"></i> Update
           </button>
           <button type="reset" class="btn btn-danger btn-sm" name="reset">
            <i class="fa fa-ban"></i> Reset
           </button>
          </div>
         </form>
         <?php
         if (isset($_POST['submit'])) {
          if (!empty($_POST['email-input']) && !empty($_POST['name-input'])) {
           $title = escape(clean($_POST['name-input']));
           $email = escape(clean($_POST['email-input']));
           $image = $_FILES['image-input']['tmp_name'];
           $name = basename($_FILES['image-input']['name']);
           move_uploaded_file($image, "../images/$name");
           $sql = "UPDATE about SET image = '{$name}', content = '{$title}', detail = '$email' where id = 1 ";
           $res = mysqli_query($connection, $sql);
           redirect("about.php");
           if (!$res) {
            die("query failed" . mysqli_error($connection));
           }
          }
         }
         ?>
        </div>
       </div>
      </div>

     </div>
    </div>
   </div>
  </div>

 </div>

 <?php include "./includes/footer.php" ?>