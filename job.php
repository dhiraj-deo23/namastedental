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
     <img src="./images/logon.svg" alt="logo" class="nav-logo" /></a>
    <button type="button" class="nav-toggle pull-right ml-4" id="nav-toggle">
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
 $sql = "SELECT * FROM jobs where active = 1 ";
 $res = query($sql);
 $row = mysqli_fetch_assoc($res);
 $title = $row['job_post'];
 $info = $row['job_content'];
 $salary = $row['salary'];
 $number = $row['number'];
 $requirement = $row['requirements'];
 $skill = $row['skills'];
 $number = $row['number'];
 $contact = $row['contact'];
 $image = $row['image'];
 ?>
 <div class="card text-white bg-primary m-4">
  <h2 class="mt-3 text-center text-uppercase"> A job Post for <?php echo $title ?></h2>
  <small class="text-center">(<?php echo $info ?>)</small>
  <div class="row mt-3">
   <div class="col-md-10 col-sm-10 mx-auto">
    <h5>Requirements:</h5>
    <?php echo $requirement ?>
    <h5 class="mt-4 ">Skills: </h5>
    <?php echo $skill ?>
    <br>
    <p class="mt-4"></p> Salary :<?php echo $salary ?><br><br>
    Number of Positions available : <?php echo $number ?><br><br>
    <p>Interested Candidates please drop their CV at mail: jobs@namastedental.com </p>
    <br>
    <p>For any query, please contact @ <?php echo $contact ?></p>
   </div>

  </div>
 </div>
 <div class="row mt-5"></div>

 <?php include "includes/footer.php"; ?>