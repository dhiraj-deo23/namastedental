<?php
require "./functions/init.php"
?>
<?php
if (!logged_in()) {
 redirect("login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <!-- Required meta tags-->
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <meta name="description" content="au theme template">
 <meta name="author" content="Hau Nguyen">
 <meta name="keywords" content="au theme template">

 <!-- Title Page-->
 <title>Calendar</title>

 <!-- Fontfaces CSS-->
 <link href="css/font-face.css" rel="stylesheet" media="all">
 <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
 <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
 <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

 <!-- Bootstrap CSS-->
 <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

 <!-- Vendor CSS-->
 <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
 <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
 <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
 <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
 <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
 <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
 <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

 <!-- FullCalendar -->
 <link href='vendor/fullcalendar-3.10.0/fullcalendar.css' rel='stylesheet' media="all" />

 <!-- Main CSS-->
 <link href="css/theme.css" rel="stylesheet" media="all">

 <style type="text/css">
  /* force class color to override the bootstrap base rule
       NOTE: adding 'url: #' to calendar makes this unneeded
     */
  .fc-event,
  .fc-event:hover {
   color: #fff !important;
   text-decoration: none;
  }
 </style>

</head>

<!-- animsition overrides all click events on clickable things like a,
      since calendar doesn't add href's be default,
      it leads to odd behaviors like loading 'undefined'
      moving the class to menus lead to only the menu having the effect -->

<body class="animsition">
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
       <div class="col">
        <div class="au-card">
         <div id="calendar"></div>
        </div>
       </div><!-- .col -->
      </div>
     </div>
    </div>
   </div>
  </div>

 </div>

 <!-- Jquery JS-->
 <script src="vendor/jquery-3.2.1.min.js"></script>
 <!-- Bootstrap JS-->
 <script src="vendor/bootstrap-4.1/popper.min.js"></script>
 <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
 <!-- Vendor JS       -->
 <script src="vendor/slick/slick.min.js">
 </script>
 <script src="vendor/wow/wow.min.js"></script>
 <script src="vendor/animsition/animsition.min.js"></script>
 <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
 </script>
 <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
 <script src="vendor/counter-up/jquery.counterup.min.js">
 </script>
 <script src="vendor/circle-progress/circle-progress.min.js"></script>
 <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
 <script src="vendor/chartjs/Chart.bundle.min.js"></script>
 <script src="vendor/select2/select2.min.js"></script>

 <!-- full calendar requires moment along jquery which is included above -->
 <script src="vendor/fullcalendar-3.10.0/lib/moment.min.js"></script>
 <script src="vendor/fullcalendar-3.10.0/fullcalendar.js"></script>

 <!-- Main JS-->
 <script src="js/main.js"></script>

 <?php
 $dates = date("Y-m-d");
 $sql = "SELECT * FROM tasks where urgent = 'on' ";
 $res = query($sql);
 if (row_count($res) !== 0) {
  $n = 0;
  while ($row = mysqli_fetch_assoc($res)) {
   $time[] = $row['time'];
   $task[] = $row['task'];
   $date_d[] = $row['date'];
   $n += 1;
  }
 } else {
  $task = "no event";
  $date_d = $dates;
 }
 $task = json_encode($task, JSON_PRETTY_PRINT);
 ?>
 <script type="text/javascript">
  $(function() {

   var task = <?php echo $task ?>;
   var day = <?php echo json_encode($date_d, JSON_PRETTY_PRINT) ?>;
   var events = [];

   for (var i = 0; i < <?php echo $n ?>; i++) {
    events.push({
     title: task[i],
     start: moment().format(day[i]),
     url: '#'
    });
   }

   // setup a few events
   $('#calendar').fullCalendar({
    header: {
     left: 'prev,next today',
     center: 'title',
     right: 'month,agendaWeek,agendaDay,listWeek'
    },
    events: events
   });
  });
 </script>


</body>

</html>
<!-- end document-->