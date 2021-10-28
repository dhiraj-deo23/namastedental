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
         <strong>Services</strong>
        </div>
        <div class="card-body card-block">
         <table class="table table-bordered table-striped table-danger">
          <thead>
           <tr>
            <th>Id</th>
            <th>Icon</th>
            <th>Title</th>
            <th>Info</th>
            <th>Edit</th>
            <th>Delete</th>
           </tr>
          </thead>
          <tbody>

           <?php
           $sql = "SELECT * FROM services";
           $res = query($sql);
           while ($row = mysqli_fetch_assoc($res)) {
            $title = $row['title'];
            $info = $row['info'];
            $icon = $row['icon'];
            $id = $row['id'];
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td><i class='fas $icon'></i></td>";
            echo "<td>$title</td>";
            echo "<td>$info</td>";
            echo "<td><a class='btn btn-primary btn-block mt-2' href='service-edit.php?edit=$id'>Edit</a></td>";
            echo "<td><a class='btn btn-primary btn-block mt-2' href='service-edit.php?delete=$id'>Delete</a></td>";
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
         <strong>Add New Services</strong>
        </div>
        <div class="card-body card-block">
         <form action="services.php" method="post" class="form-horizontal">

          <div class="row form-group">
           <div class="col col-md-3">
            <label for="text-input" class=" form-control-label">Enter the Title for the service</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="text" name="title-input" placeholder="Title" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="email-input" class=" form-control-label">The icon for the Service</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="text" name="icon-input" placeholder="Font Awesome Icon" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="info-input" class=" form-control-label">Details of Service</label>
           </div>
           <div class="col-12 col-md-9">
            <textarea type="text" name="info-input" placeholder="Service Info" class="form-control"></textarea>
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
          if (!empty($_POST['icon-input']) && !empty($_POST['info-input']) && !empty($_POST['title-input'])) {
           $title = escape(clean($_POST['title-input']));
           $icon = escape(clean($_POST['icon-input']));
           $info = escape(clean($_POST['info-input']));
           $sql = "INSERT INTO services(icon, title, info) VALUES ('{$icon}', '{$title}', '{$info}') ";
           $res = mysqli_query($connection, $sql);
           if (!$res) {
            echo mysqli_error($connection);
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