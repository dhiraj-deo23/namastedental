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
     <?php
     if (isset($_POST['search-submit']) && !empty($_POST['search'])) {
      $search = escape($_POST['search']);
      $sql = "SELECT * FROM appointment where name LIKE '%$search%' or reason LIKE '%$search%' or description LIKE '%$search%' or status LIKE '%$search%' ";
      $res = query($sql);
      $count = row_count($res);
      if ($count > 0) {
       echo "<div class='alert alert-success'>Your search matched $count results</div>";
     ?>
       <div class="row">
        <div class="col-lg-12">
         <div class="table-responsive table--no-card m-b-30">
          <h3 class="title-5 mb-1">Appointments</h3>
          <table class="table table-borderless table-striped table-earning">
           <thead>
            <tr>
             <th>Appointment ID</th>
             <th>Date</th>
             <th>name</th>
             <th>phone</th>
             <th class="text-right">Status</th>
             <th class="text-right">Description</th>
            </tr>
           </thead>
           <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
             $id = $row['appointment_id'];
             $date = $row['date_appointment'];
             $name = $row['name'];
             $phone = $row['phone'];
             $status = $row['status'];
             $description = $row['description'];
             echo "<tr>";
             echo "<td>$id</td>";
             echo "<td>$date</td>";
             echo "<td>$name</td>";
             echo "<td>$phone</td>";
             echo "<td>$status</td>";
             echo "<td>$description</td>";
             echo "</tr>";
            }
            ?>
           </tbody>
          </table>
         </div>
        </div>
       </div>

     <?php

      } else {
       echo "<div class='alert alert-danger'>Your search matched $count results</div>";
      }
     } else {
      redirect("index.php");
     }


     ?>




    </div>
   </div>
  </div>
 </div>
</div>

<?php include "./includes/footer.php" ?>