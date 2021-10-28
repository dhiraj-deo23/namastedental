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
       <div class="overview-wrap">
        <h2 class="title-1">overview</h2>
       </div>
      </div>
     </div>
     <div class="row m-t-25">
      <div class="col-sm-6 col-lg-3">
       <div class="overview-item overview-item--c1">
        <div class="overview__inner">
         <div class="overview-box clearfix">
          <div class="icon">
           <i class="zmdi zmdi-account-o"></i>
          </div>

          <div class="text">
           <h2><?php
               $date = date("Y-m-d");
               count_app($date);
               ?></h2>
           <span>Today's Appointments</span>
          </div>
         </div>
        </div>
       </div>
      </div>
      <div class="col-sm-6 col-lg-3">
       <div class="overview-item overview-item--c2">
        <div class="overview__inner">
         <div class="overview-box clearfix">
          <div class="icon">
           <i class="zmdi zmdi-accounts"></i>
          </div>
          <div class="text">
           <h2><?php
               $date = new DateTime("tomorrow");
               $date = date_format($date, "Y-m-d");
               count_app($date);
               ?></h2>
           <span>tommorow's appointment</span>
          </div>
         </div>
        </div>
       </div>
      </div>
      <div class="col-sm-6 col-lg-3">
       <div class="overview-item overview-item--c3">
        <div class="overview__inner">
         <div class="overview-box clearfix">
          <div class="icon">
           <i class="zmdi zmdi-calendar-note"></i>
          </div>
          <div class="text">
           <h2><?php count_week(); ?></h2>
           <span>this week appointment</span>
          </div>
         </div>
         <!-- <div class="overview-chart">
          <canvas id="widgetChart3"></canvas>
         </div> -->
        </div>
       </div>
      </div>
      <div class="col-sm-6 col-lg-3">
       <div class="overview-item overview-item--c4">
        <div class="overview__inner">
         <div class="overview-box clearfix">
          <div class="icon">
           <i class="zmdi zmdi-case"></i>
          </div>
          <div class="text">
           <h2><?php count_app2();  ?></h2>
           <span>total pending appointment</span>
          </div>
         </div>
        </div>
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-lg-12">
       <h2 class="title-1 m-b-25">Appointment Details</h2>
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
      </div>
     </div>
     <?php
     if (isset($_POST['task_submit'])) {
      add_task();
     }

     ?>
     <form action="" method="POST">
      <div class="row">
       <div class="col-lg-6">
        <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
         <div class="au-card-title" style="background-image:url('images/bg-title-01.jpg');">
          <div class="bg-overlay bg-overlay--blue"></div>
          <h3>
           <i class="zmdi zmdi-account-calendar"></i><?php
                                                     $date = date("dS M Y");
                                                     echo $date;
                                                     echo " (";
                                                     echo date("D");
                                                     echo ")";
                                                     ?></h3>
          <button class="au-btn-plus" id="task_add">
           <i class="zmdi zmdi-plus"></i>
          </button>
         </div>
         <div class="au-task js-list-load">
          <div class="au-task__title">
           <p>Tasks for Niraj Dev</p>
          </div>
          <div class="au-task-list js-scrollbar3">
           <div class="au-task__item au-task__item--danger" id="parent_task">
            <?php
            $date = date("Y-m-d");
            $sql = "SELECT * FROM appointment where date_appointment = '$date' ";
            $res = query($sql);
            while ($row = mysqli_fetch_assoc($res)) {
             $time = $row['time_appointment'];
             $name = $row['name'];
             $reason = $row['reason'];
            ?>
             <div class="au-task__item-inner" id="child_task">
              <h5 class="task">
               <a href="#">Appointment with <strong><?php echo $name ?></strong> regarding <em><?php echo $reason ?></em></a>
              </h5>
              <span class="time"><?php echo $time ?></span>
             </div>
            <?php
            }
            ?>
            <?php receive_task(); ?>
           </div>
          </div>
          <div class="au-task__footer">
           <button class="au-btn au-btn-load js-load-btn">load more</button>
          </div>
         </div>
        </div>
       </div>
       <div class="col-lg-6">
        <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
         <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
          <div class="bg-overlay bg-overlay--blue"></div>
          <h3>
           <i class="zmdi zmdi-comment-text"></i>New Messages</h3>
          <button class="au-btn-plus">
           <i class="zmdi zmdi-plus"></i>
          </button>
         </div>
         <div class="au-inbox-wrap js-inbox-wrap">
          <div class="au-message js-list-load">
           <div class="au-message__noti">
            <p>You Have
             <span><?php num_unread_messages(); ?></span>

             new messages
            </p>
           </div>
           <div class="au-message-list">
            <div class="au-message_">
             <?php unread_messages();  ?>
            </div>
           </div>
           <div class="au-message__footer">
            <button class="au-btn au-btn-load js-load-btn">load more</button>
           </div>
          </div>
         </div>
        </div>
       </div>
      </div>
     </form>
    </div>
   </div>
  </div>
  <!-- END MAIN CONTENT-->
  <!-- END PAGE CONTAINER-->
 </div>

</div>
<script>
 document.getElementById('task_add').addEventListener("click", (e) => {
  e.preventDefault();
  const form = document.createElement('form');
  form.className = "task-form";
  form.method = "POST";
  form.innerHTML = `
             <div class="au-task__item-inner" id="child_task">
              <input class="text-info form-control" type="date" name="task_date" >
              <h5 class="task">
               <input class="form-control mt-2" name="task_input" placeholder= "Enter the Task">
              </h5>
              <input type="time" name="time_input" placeholder="   Time">
              <input type="checkbox" name="urgent"><em class="text-danger mr-1">  urgent</em>
              <button type="submit" class="btn btn-primary" id="task_submit" name="task_submit">Submit</button>
              <button type="submit" class="btn btn-danger" id= "task_close" >Close</button>
             </div>
          `;
  const parent = document.getElementById('parent_task');
  parent.insertAdjacentElement('afterbegin', form);
  document.getElementById('task_close').addEventListener("click", () => {
   form.remove();
  });
 })
</script>

<?php include "./includes/footer.php" ?>