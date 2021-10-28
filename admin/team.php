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
         <strong>Facilities</strong>
        </div>
        <div class="card-body card-block">
         <table class="table table-bordered table-striped table-danger">
          <thead>
           <tr>
            <th>Id</th>
            <th>Email</th>
            <th>Image</th>
            <th>Name</th>
            <th>Info</th>
            <th>Edit</th>
            <th>Delete</th>
           </tr>
          </thead>
          <tbody>

           <?php
           $sql = "SELECT * FROM team";
           $res = query($sql);
           while ($row = mysqli_fetch_assoc($res)) {
            $name = $row['name'];
            $info = $row['content'];
            $image = $row['image'];
            $id = $row['id'];
            $email = $row['email'];
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$email</td>";
            echo "<td><img src='../images/$image' alt='facility-image'></td>";
            echo "<td>$name</td>";
            echo "<td>$info</td>";
            echo "<td><a class='btn btn-primary btn-block mt-2' href='team-edit.php?edit=$id'>Edit</a></td>";
            echo "<td><a class='btn btn-primary btn-block mt-2' href='team-edit.php?delete=$id'>Delete</a></td>";
            echo "</tr>";
           }
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
         <strong>Add Team Members</strong>
        </div>
        <div class="card-body card-block">
         <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="text-input" class=" form-control-label">Enter the Name of Doctor</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="text" name="name-input" placeholder="Name" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="text-input" class=" form-control-label">Enter the Email</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="email" name="email-input" placeholder="Email" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="image" class="form-control-label">Upload an image</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="file" name="image-input" placeholder="" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="info-input" class=" form-control-label">Team Member's Info</label>
           </div>
           <div class="col-12 col-md-9">
            <textarea type="text" name="info-input" placeholder="Facility Info" class="form-control"></textarea>
           </div>
          </div>
          <div class="card-footer">
           <button type="submit" class="btn btn-primary btn-sm" name="submit">
            <i class="fa fa-dot-circle-o"></i> Submit
           </button>
           <button type="reset" class="btn btn-danger btn-sm" name="reset">
            <i class="fa fa-ban"></i> Reset
           </button>
          </div>
         </form>
         <?php
         if (isset($_POST['submit'])) {
          if (!empty($_POST['info-input']) && !empty($_POST['name-input']) && !empty($_POST['email-input'])) {
           $title = escape(clean($_POST['name-input']));
           $email = escape(clean($_POST['email-input']));
           $image = $_FILES['image-input']['tmp_name'];
           $name = basename($_FILES['image-input']['name']);
           move_uploaded_file($image, "../images/$name");
           $info = escape(clean($_POST['info-input']));
           if (!mail_exist($email)) {
            $sql = "INSERT INTO team(email, image, name, content) VALUES ('$email', '{$name}', '{$title}', '{$info}') ";
            $res = mysqli_query($connection, $sql);
            if (!$res) {
             echo mysqli_error($connection);
            }
           } else {
            echo "email already exists";
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