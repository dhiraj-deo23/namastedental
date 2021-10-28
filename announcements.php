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
 $sql = "SELECT * FROM announcements where active = 1 ";
 $res = query($sql);
 $row = mysqli_fetch_assoc($res);
 $title = $row['heading'];
 $image = $row['image'];
 $detail = $row['full_desc'];
 $content = $row['short_desc'];

 ?>
 <div class="card text-white bg-primary">
  <h3 class="mt-3 text-center text-uppercase"><?php echo $title ?></h3>
  <div class="row">
   <div class="col-md-10 col-sm-10">
    <img src="images/<?php echo $image ?>" alt="">
   </div>
   <div class="col-md-2 col-sm-2 align-self-center p-2">
    <p class="pr-4"><?php echo $content ?></p>
   </div>
   <div class="row mt-2">
    <div class="col-md-12 col-sm-12">
     <p class="ml-5 p-4"><?php echo $detail ?></p>
    </div>
   </div>
  </div>
 </div>
 <div class="row mt-5"></div>

 <?php include "includes/footer.php"; ?>