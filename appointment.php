<?php include "includes/db.php"; ?>
<?php include "includes/functions.php"; ?>
<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <title>Namaste Dental and Oral Health Care</title>
 <link rel="stylesheet" href="./fontawesome-free-5.14.0-web/css/all.css" />
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
 <link rel="stylesheet" href="main.css" />
 <link rel="stylesheet" href="main2.css" />
 <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
</head>

<body>
 <div class="header-head" id="home">
  <div class="header-top">
   <h1 class="head-address">Udaypur-11, Gaighat</h1>
   <a href="tel:9862989889">
    <h2 class="head-phone">+9779862989889</h2>
   </a>
   <!-- <a href="#" class="head mail">kr.nirajdev@gmail.com</a> -->
   <div class="head-links">
    <a href="https://www.facebook.com/Namaste-Dental-And-Oral-Health-Care-Center-120659259844969/" class="social" target="_blank">
     <span class="social-link"> <i class="fab fa-facebook"></i> </span></a>
    <a href="#" class="social"><span class="social-link"> <i class="fab fa-instagram"></i> </span></a>
    <a href="#" class="social">
     <span class="social-link"> <i class="fab fa-twitter"></i> </span></a>
   </div>
   <!-- <div class="admin">
      <a href="admin/login.php" class="admin-login">Admin</a>
    </div> -->
  </div>
 </div>

 <!-- navbar -->
 <nav class="navbar">
  <div class="nav-center">
   <div class="nav-header">
    <a href="./index.php">
     <img src="./images/logon.svg" alt="logo" class="nav-logo" />
     <button type="button" class="nav-toggle" id="nav-toggle" aria-label="nav-toggle"></a>
    <i class="fas fa-bars"></i>
    </button>
   </div>
   <div class="nav-links" id="nav-links">
    <a href="./index.php" class="nav-link">home</a>
    <a href="./index.php" class="nav-link ">about us</a>
    <a href="./index.php" class="nav-link">facilities</a>
    <a href="./appointment.php" class="nav-link ">appointment</a>
    <a href="./index.php" class="nav-link">contact us</a>
   </div>
  </div>
 </nav>

 <?php
 if (isset($_POST['request'])) {
  $name = escape($_POST['name']);
  $age = escape($_POST['age']);
  $gender = escape($_POST['gender']);
  $email = escape($_POST['email']);
  $number = escape($_POST['number']);
  $patient_history = escape($_POST['patient_history']);
  $reason = escape($_POST['reason']);
  $appointment_date = escape($_POST['appointment_date']);
  $appointment_time = escape($_POST['appointment_time']);
  $status = "pending";
  $description = "";
  $notify = 0;
  $query = "INSERT INTO appointment(name, gender, age, previous_checkup, email, phone, reason, date_request, date_appointment, time_appointment, status, description, notify) VALUES('$name', '$gender', '$age', '$patient_history', '$email', '$number', '$reason', now(), '$appointment_date', '$appointment_time', '$status', '$description', $notify)";
  $make_appointment = mysqli_query($connection, $query);
  if ($make_appointment) {
   $_SESSION['message'] = "Your appointment has been made";
   setcookie("message", $_SESSION['message'], time() + 60);
   $subject = "Appointment for $appointment_date ";
   $mesg = "Your appointment has been made. Please visit the clinic at requested date: $appointment_date and time: $appointment_time.
   Thank You
   Namaste Dental and Oral Health Care Center Pvt. Ltd.
   Gaighat-11, Udayapur ";
   send_email($email, $subject, $mesg);

 ?>
   <script>
    alert("Your appointment has been made");
   </script>
 <?php
  }
 }

 ?>


 <div class="container bg-secondary col-md-8">
  <div class="row justify-content-md-center ">
   <div class="col-lg-10 ">
    <form action="" method="post">
     <h4 class="text-center text-primary head-text mt-4">Appointment Form</h4>
     <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" id="" class="form-control" placeholder="Full Name" required>
     </div>
     <div class="form-group">
      <label for="name">Gender</label><br>

      <select name="gender" id="" required>
       <option value="male">Male</option>
       <option value="female">Female</option>
       <option value="others">Others</option>
      </select>


     </div>
     <div class="form-group">
      <label for="age">Age</label>
      <input type="number" name="age" id="" class="form-control" placeholder="Your Age" required>
     </div>
     <div class="form-group">
      <label for="name">Are you a new or existing patient?</label>
      <select name="patient_history" id="" required class="form-control">
       <option value="new">New</option>
       <option value="existing">Existing</option>
      </select>
     </div>
     <div class="form-group">
      <label for="name">Email</label>
      <input type="Email" name="email" id="" class="form-control" placeholder="example@example.com">
     </div>
     <div class="form-group">
      <label for="name">Enter your Number</label>
      <input type="number" name="number" id="" class="form-control" placeholder="phone/mobile" required>
     </div>
     <div class="form-group">
      <label for="name">Why are you requesting an appointment today?</label>
      <textarea name="reason" id="" cols="30" rows="5" class="form-control" placeholder="Kindly specify the reason"></textarea>
     </div>
     <div class="form-group">
      <label for="name">For when would you like to make an appointment?</label>
      <input type="Date" name="appointment_date" id="appoint_date" class="form-control" placeholder="dd/mm/yy" required>
     </div>
     <div class="form-group">
      <label for="name">Please enter the time for an appointment (opening hours 8:00AM to 8:00PM)</label>
      <div class="row">
       <div class="col-md-11 col-sm-11">
        <input type="Time" min="08:00" max="20:00" name="appointment_time" id="appoint_time" placeholder="hh:mm" class="form-control" required>
       </div>
       <div class="col-md-1 col-sm-1 p-2 ">
        <span class="validity text-primary"><i class="fa fa-check"></i></span>
       </div>
      </div>
     </div>
     <div class="form-group">
      <input type="submit" name="request" id="" value="Make an Appointment" class="btn btn-danger">
     </div>


   </div>
  </div>
 </div>

 </form>

 <?php
 $dates = new DateTime("now", timezone_open("Asia/Kathmandu"));
 $date_now = $dates->format("Y-m-d");
 $time_now = $dates->format("H:i:s");
 $sql = "SELECT * FROM appointment ";
 $res = mysqli_query($connection, $sql);
 while ($row = mysqli_fetch_assoc($res)) {
  $date[] = $row['date_appointment'];
  $time[] = $row['time_appointment'];
 }
 $date = json_encode($date);
 $time = json_encode($time);
 ?>

 <script>
  document.querySelector('.validity').style.display = "none";
  const dates = <?php echo $date ?>;
  const times = <?php echo $time ?>;
  const dateNow = '<?php echo $date_now ?>';
  const timeNow = '<?php echo $time_now ?>';
  const dateAppointment = document.getElementById('appoint_date');
  const timeAppointment = document.getElementById('appoint_time');
  timeAppointment.value = "08:00";
  const nowDate = new Date();
  nowDate.setDate(nowDate.getDate() + 1);
  const tomDate = nowDate.toISOString();
  const selDate = tomDate.split("T");
  dateAppointment.setAttribute("min", selDate[0]);


  dateAppointment.addEventListener("input", (e) => {
   const dateInput = e.target.value;
   timeAppointment.addEventListener("input", (e) => {
    const timeInput = e.target.value + ":00";
    const mins = timeInput.split(":");
    if (mins[1] != "00") {
     alert("please select in hours");
     timeAppointment.value = "08:00";
    }
    dates.forEach((date, index) => {
     if (date == dateInput) {
      if (times[index] == timeInput) {
       alert("Sorry, the selected date is not available. Please select other date");
       timeAppointment.value = "";
      } else {
       document.querySelector('.validity').style.display = "block";
      }
     }
    });
   });


   // if (dateInput < dateNow) {
   //  alert("You cannot select such date");
   //  dateAppointment.value = "";
   // } else if (dateInput == dateNow) {
   //  timeAppointment.addEventListener("input", (e) => {
   //   const timeInput = e.target.value + ":00";
   //   if (timeInput <= timeNow) {
   //    alert("Please select proper time");
   //    timeAppointment.value = "";
   //   }
   //  })
   // } else if (dateInput >= dateNow) {
   //  timeAppointment.addEventListener("input", (e) => {
   //   const timeInput = e.target.value + ":00";
   //   dates.forEach((date, index) => {
   //    if (date == dateInput) {
   //     if (times[index] == timeInput) {
   //      alert("Sorry, the selected date is not available. Please select other date");
   //      timeAppointment.value = "";
   //     } else if (timeInput < "08:00:00" || timeInput > "20:00:00") {
   //      alert("Select the time within opening hours");
   //      timeAppointment.value = "";
   //     } else {
   //      document.querySelector('.validity').style.display = "block";
   //     }
   //    }
   //   })
   //  })
   // }
  })
 </script>

 <?php include "includes/footer.php"; ?>