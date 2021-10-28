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
      <div class="col-lg-12">
       <div class="table-responsive table--no-card m-b-30">
        <h3 class="title-5 mb-1">Today's Appointments</h3>
        <table class="table table-borderless table-striped table-earning">
         <thead>
          <tr>
           <th>Time</th>
           <th>Appointment ID</th>
           <th>name</th>
           <th class="text-right">New/Existing</th>
           <th class="text-right">Details</th>
          </tr>
         </thead>
         <tbody>
          <?php
          $date = date('yy-m-d');
          appointments($date);
          ?>
         </tbody>
        </table>
       </div>
       <div class="table-responsive table--no-card m-b-30">
        <h3 class="title-5 mb-1">Tomorrow's Appointments</h3>
        <table class="table table-borderless table-striped table-earning">
         <thead>
          <tr>
           <th>Time</th>
           <th>Appointment ID</th>
           <th>name</th>
           <th class="text-right">New/Existing</th>
           <th class="text-right">Details</th>
          </tr>
         </thead>
         <tbody>
          <?php
          $date1 = new DateTime("tomorrow");
          $date1 = $date1->format("Y-m-d");
          appointments($date1);
          ?>
         </tbody>
        </table>
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-md-12">
       <!-- DATA TABLE -->
       <h3 class="title-5 m-b-35">Process Appointments</h3>
       <?php
       if (isset($_POST['checkbox'])) {
        $id = $_POST['checkbox'];
        if (isset($_POST['app_delete'])) {
         foreach ($id as $ids) {
          $sql = "DELETE from appointment where appointment_id = $ids ";
          $res = query($sql);
         }
        } elseif (isset($_POST['app_process'])) {
         foreach ($id as $ids) {
          $sql = "UPDATE appointment SET status = 'processed' where appointment_id = $ids ";
          $res = query($sql);
         }
        } elseif (isset($_POST['app_cancel'])) {
         foreach ($id as $ids) {
          $sql = "UPDATE appointment SET status = 'cancelled' where appointment_id = $ids ";
          $res = query($sql);
          if ($res) {
           $sql2 = "SELECT * FROM appointment where appointment_id = $ids ";
           $res2 = query($sql2);
           $row = mysqli_fetch_assoc($res2);
           $email = $row['email'];
           $name = $row['name'];
           $date = $row['date_appointment'];
           $subject = "Appointment Cancelled";
           $message = "Dear $name, <br>
           We are sorry to inform you that your appointment for the requested date $date has been cancelled for some reasons.<br>
           Please request another appointment. <br>
           Thank You <br>
           Namaste Dental and Oral Health Care Center Pvt. Ltd. <br>
           Gaighat-11, Udayapur
           ";
           send_email($email, $subject, $message);
          }
         }
        }
       }
       ?>
       <?php

       if (isset($_POST['add_submit'])) {
        $id = $_POST['id_find'];
        $description = $_POST['desc_input'];
        $sql = "UPDATE appointment SET description = '$description' where appointment_id = $id ";
        $res = query($sql);
       }

       ?>
       <form method="POST">
        <div class="table-data__tool">
         <div class="table-data__tool-left">
          <div class="rs-select2--light rs-select2--md">
           <select class="js-select2" name="appointment_option" id="app_option">
            <option value="today">Today's</option>
            <option value="tomorrow">Tommorrow</option>
            <option value="this week">This Week</option>
            <option value="all">All</option>
           </select>
           <div class="dropDownSelect2"></div>
          </div>
          <button class="au-btn-filter" name="filter" type="submit" id="filter">
           <i class="zmdi zmdi-filter-list"></i>filters</button>
         </div>
         <div class="table-data__tool-right">
          <button class="au-btn au-btn-icon au-btn--blue au-btn--small" type="submit" name="app_delete">
           <i class="zmdi zmdi-delete"></i>Delete</button>
          <button class="au-btn au-btn-icon au-btn--blue au-btn--small" type="submit" name="app_process">
           <i class="zmdi zmdi-plus"></i>Process</button>
          <button class="au-btn au-btn-icon au-btn--blue au-btn--small" type="submit" name="app_cancel">
           <i class="zmdi zmdi-minus"></i>Cancel</button>
         </div>
        </div>
        <div class="table-responsive table-responsive-data2">
         <table class="table table-data2">
          <thead>
           <tr>
            <th>
             <label class="au-checkbox">
              <input type="checkbox" id="selectallfields">
              <span class="au-checkmark"></span>
             </label>
            </th>
            <th>Date</th>
            <th>day</th>
            <th>name</th>
            <th>gender</th>
            <th>phone</th>
            <th>status</th>
            <th>add description</th>
            <th></th>
           </tr>
          </thead>
          <tbody>
           <?php
           if (isset($_POST['filter'])) {
            $appointment_option = $_POST['appointment_option'];
            switch ($appointment_option) {
             case "today";
              $date = new DateTime("today");
              $tomm = new DateTime("tomorrow");
              process_appointment($date, $tomm);
              break;
             case "tomorrow";
              $date = new DateTime("tomorrow");
              date_add($date, date_interval_create_from_date_string("1 days"));
              $tomm = new DateTime("tomorrow");
              process_appointment($tomm, $date);
              break;
             case "this week";
              $day = date("N");
              $add = 6 - $day;
              $date = new DateTime("today");
              date_add($date, date_interval_create_from_date_string("$add days"));
              $today = new DateTime("today");
              process_appointment($today, $date);
              break;
             case "all";
              $date = new DateTime("2020-01-01");
              $date1 = new DateTime("today");
              date_add($date1, date_interval_create_from_date_string("365 days"));
              process_appointment($date, $date1);
              break;
             default;
              $date = new DateTime("today");
              date_add($date, date_interval_create_from_date_string("7 days"));
              $date_now = new DateTime("today");
              process_appointment($date_now, $date);
              break;
            }
           } else {
            $date = new DateTime("today");
            date_add($date, date_interval_create_from_date_string("7 days"));
            $date_now = new DateTime("today");
            process_appointment($date_now, $date);
           }
           ?>
          </tbody>
       </form>

       <script>
        document.getElementById('selectallfields').addEventListener("click", (e) => {
         const fields = document.querySelectorAll('#selectfield');
         if (e.target.checked) {
          fields.forEach(field => {
           field.checked = true;
          });
         } else {
          fields.forEach(field => {
           field.checked = false;
          });
         }
        });
        const add_description = document.querySelectorAll('#add_description');
        add_description.forEach(add => {
         add.addEventListener("click", (e) => {
          const prev = e.target.parentElement.parentElement.firstChild.firstChild.nextSibling.firstChild.nextSibling.value;
          const form = document.createElement('form');
          form.className = "add-form";
          form.method = "POST";
          form.innerHTML = `
            <div class="row mt-3">
             <div class="col-md-6 mx-auto">
              <div class="card">
               <div class="card-body" id="simply_card">
                <div class="form-group">
                 <label for="">Enter the description</label>
                 <textarea class="form-control" name="desc_input"></textarea>
                 <input type="hidden" name="id_find" value="${prev}">
                </div>
                <button type="submit" class="btn btn-primary" id="add_submit" name="add_submit">Submit</button>
                <button type="submit" class="btn btn-primary" id= "add_close" name="add_close">Close</button>
               </div>
              </div>
             </div>
            </div>
          `;
          const parent = document.querySelector('.table-responsive.table-responsive-data2');
          const child = document.querySelector('.table.table-data2');
          parent.insertBefore(form, child);
          document.getElementById('add_close').addEventListener("click", () => {
           form.remove();
          });
          window.addEventListener("click", (e) => {
           const check = document.querySelector('#simply_card');
           e.target == check ? form.remove() : false;
          });
         })
        });
       </script>
       </table>
      </div>
      <!-- END DATA TABLE -->
     </div>
     <div class="row mt-5">
      <div class="col-lg-12">
       <div class="table-responsive table--no-card m-b-30">
        <h3 class="title-5 mb-1">Read Descriptions</h3>
        <small>Past Appointments</small>
        <table class="table table-borderless table-striped table-earning mt-2">
         <thead>
          <tr>
           <th>ID</th>
           <th>Date</th>
           <th>name</th>
           <th class="text-right">Phone</th>
           <th class="text-right">Description</th>
          </tr>
         </thead>
         <tbody>
          <?php
          descriptions();
          ?>
         </tbody>
        </table>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>

<?php include "./includes/footer.php" ?>