<?php include "includes/header.php"; ?>


<div class="header-head" id="home">
 <div class="header-top">
  <h1 class="head-address">Udaypur-11, Gaighat</h1>
  <a href="tel:9862989889">
   <h2 class="head-phone">9862989889, 9817706162</h2>
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

<header class="home">
 <?php include "includes/navigation.php"; ?>
 <div class="hero">
  <div class="announcements">
   <a href="announcements.php" class="flying-text"><?php get_announcement();  ?></a>
  </div>
  <div class="job-posts">
   <div class="card">
    <?php
    $sql = "SELECT * FROM jobs where active = 1 ";
    $res = query($sql);
    $count = mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);
    $title = $row['job_post'];
    $info = $row['job_content']
    ?>
    <a href="job.php">
     <h3 class="heading"><?php echo $title ?></h3>
     <p class="content"><?php echo $info ?></p>
    </a>
   </div>
  </div>
  <div class="hero-banner">
   <h2 class="hero-title">"your smile,</h2>
   <h1 class="hero-subtitle">our responsibility"</h1>
   <a href="appointment.php" class="banner-bttn">book an appointment</a>
  </div>
 </div>
</header>

<script>
 document.querySelector('.flying-text').style.display = "red";
</script>
<!-- about section -->
<section class="section about" id="about">
 <div class="title-universal">
  <h2 class="title">about <span class="subtitle">us</span></h2>
 </div>
 <div class="about-center section-center">
  <?php
  $query = "SELECT * FROM about";
  $res = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($res);
  $img = $row['image'];
  $content = $row['content'];
  $detail = $row['detail'];
  ?>
  <article class="about-img">
   <img src="./images/<?php echo $img ?>" alt="" class="about-pic" />
  </article>
  <article class="about-info">
   <h3>know your dentist closely</h3>
   <p>
    <?php echo $content ?>
   </p>
   <p>
    <?php echo $detail ?>

   </p>
   <a href="#" class="btn-primary">read more</a>
  </article>
 </div>
</section>
<section class="section specialities">
 <div class="title-universal">
  <h2 class="title">why choose <span class="subtitle">Namaste</span></h2>
  <p class="subtext">
   let's make your smile great again
   <span class="smiley"><i class="far fa-smile"></i></span>
  </p>
 </div>

 <div class="speciality-center section-center">
  <?php

  $query = "SELECT * FROM services";
  $res = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($res)) {
   $icon = $row['icon'];
   $title = $row['title'];
   $info = $row['info'];
  ?>
   <article class="speciality">
    <span class="special-icon"><i class="fas <?php echo $icon ?>"></i>
    </span>
    <div class="service-description">
     <h3 class="service-title"><?php echo $title ?></h3>
     <p class="service-info">
      <?php echo $info  ?>
     </p>
    </div>
   </article>
  <?php
  }
  ?>
 </div>
</section>
<section class="section facilities" id="facilities">
 <div class="title-universal">
  <h2 class="title">Our <span class="subtitle">Facilities</span></h2>
  <p class="subtext">we provide best quality treatment</p>
 </div>
 <div class="section-center facility-center">
  <?php
  $query = "SELECT * FROM facilities ORDER BY FIELD(id, 2, 4, 1, 5) ";
  $res = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($res)) {
   $image = $row['image'];
   $heading = $row['heading'];
   $content = $row['content'];
   $description = $row['description'];
  ?>
   <article class="facility">
    <div class="facility-img-container">
     <img src="./images/<?php if($image == "") { ?>random.jpg <?php } else {  echo $image;   }?>" alt="" class="facility-image" />
     <h1 class="facility-title"><?php echo $heading ?></h1>
    </div>
    <div class="fac-cont">
    <p class="facility-info"><?php echo $content ?></p>
    </div>
    <div class="fac-content">
     <p class="facility-info">
      <?php echo $description ?>
     </p>
     <!-- <a href="" class="bttn-secondary">read more</a> -->
    </div>
   </article>
  <?php
  }
  ?>
 </div>
</section>
<section class="section gallery">
 <div class="title-universal">
  <h2 class="title">Our <span class="subtitle">Team</span></h2>
  <p class="subtext">highly experienced professionals</p>
 </div>
 <div class="section-center team-center">
  <?php
  $query = "SELECT * FROM team";
  $res = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($res);
  $img = $row['image'];
  $name = $row['name'];
  $content = $row['content'];
  ?>
  <article class="team">
   <div class="team-image-container">
    <img src="./images/<?php echo $img ?>" alt="" class="team-image" />
   </div>
   <div class="team-content">
    <h1 class="doc-name"><?php echo $name ?></h1>
    <p class="doc-info">
     <?php echo $content ?>
    </p>
    <!-- <a href="#" class="bttn-secondary">know more</a> -->
   </div>
  </article>
 </div>
</section>
<section class="section appointment" id="appointment">
 <div class="appointment-info">
  <h1 class="appointment-title">say bye bye to your toothache</h1>
  <p class="appointment-sub">welcome pretty smile</p>
  <p class="subt">call us or book your appointment today</p>
  <a href="appointment.php" class="banner-bttn">book appointment</a>
 </div>
</section>
<section class="contact" id="contact">
 <div class="contact-header">
  <h1 class="contact-head">contact us</h1>
  <div class="border"></div>
 </div>
 <div class="contact-center section-center">
  <article class="con-all">
   <div class="con-info">
    <i class="fa fa-map-marker"></i>
    <p class="con-tex">Udaypur-11, gaighat</p>
   </div>
   <!-- <div class="con-info">
    <i class="fa fa-phone"></i>
    <p class="con-tex"> </p>
   </div> -->
   <div class="con-info">
    <i class="fa fa-mobile-alt"></i>
    <a href="tel:9862989889">
     <p class="con-tex">9862989889</p>
    </a>
   </div>
   <a href="mailto: contact@namastedental.com" target="_blank">
    <div class="con-info">
     <i class="fa fa-envelope"></i>
     <p class="con-tex">contact@namastedental.com</p>
    </div>
   </a>
  </article>
  <article class="mail">

   <?php
   if (isset($_POST['send'])) {
    $user_name = $_POST['name'];
    $user_subject = $_POST['subject'];
    $user_email = $_POST['email'];
    $user_message = $_POST['message'];
    $reply = "";
    if (!empty($user_name) && !empty($user_subject) && !empty($user_email) && !empty($user_message)) {


     $query = "INSERT INTO message(name, subject, email, message_text, date, status, reply) VALUE('$user_name', '$user_subject', '$user_email', '$user_message', now(), 0, '$reply' )";
     $send_query = mysqli_query($connection, $query);
     echo "Your message has been sent";
     if (!$send_query) {
      die("QUERY FAILED" . mysqli_error($connection));
     }
    }
   }
   ?>

   <form action="" class="form" method="POST">
    <label for="name">name</label>
    <input type="text" name="name" id="name-msg" required /><br />
    <label for="mail">e-mail</label>
    <input type="email" name="email" id="" required /><br />
    <label for="subject">subject</label>
    <input type="text" name="subject" id="" required /><br />
    <label for="message">message</label>

    <textarea name="message" id="" cols="30" rows="5" required></textarea><br />

    <input name="send" type="submit" value="send" class="bttn" />
   </form>
  </article>
 </div>
</section>
<script>
 const i = '<?php echo $count ?>';
 if (i == 1) {
  document.querySelector('.job-posts').style.display = "block";
 } else {
  document.querySelector('.job-posts').style.display = "none";

 }
</script>
<?php include "includes/footer.php"; ?>