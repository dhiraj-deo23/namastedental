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
     if (isset($_POST['msg_submit'])) {
      $id = $_POST['id_get'];
      $reply_msg = $_POST['msg_name'];
      $sql = "UPDATE message SET reply = '$reply_msg' where message_id = $id ";
      $res = query($sql);
      $sql2 = "SELECT * FROM message where message_id = $id ";
      $res2 = query($sql2);
      $row = mysqli_fetch_assoc($res2);
      $email = $row['email'];
      $name = $row['name'];
      $sub = $row['subject'];
      $message = "Dear $name, <br>
 Thank you for messaging us. <br>
 $reply_msg <br>
 Namaste Dental and Oral Health Care Center Pvt. Ltd. <br>
 Gaighat-11, Udayapur
 ";
      $subject = "Re: $sub";
      send_email($email, $subject, $message);
     }
     ?>
     <div class="row">
      <div class="col-lg-12 col-md-12 alert alert-danger">
       <button class="text-primary" id="message-btn"><i class="zmdi zmdi-email"></i> See and Reply to Messages</button>
       <button class="text-primary pull-right" id="msg-back-btn"><i class="zmdi zmdi-long-arrow-left"></i> BACK</button>
      </div>
     </div>
     <div class="row" id="message-row">
      <div class="col-lg-10 col-md-10 mx-auto">
       <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
        <div class="au-card-title" style="background-image:url('images/bg-title-02.jpg');">
         <div class="bg-overlay bg-overlay--blue"></div>
         <h3>
          <i class="zmdi zmdi-comment-text"></i>See Messages</h3>
         <button class="au-btn-plus" id="back-btn">
          <i class="zmdi zmdi-long-arrow-left"></i>
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
     <div class="row mt-3">
      <div class="col-lg-12 col-md-12 alert alert-info">
       <button class="text-primary" id="announcement-btn"><i class="fa fa-bullhorn"></i> Announcements</button>
       <button class="text-primary pull-right" id="announcement-back-btn"> <i class="zmdi zmdi-long-arrow-left"></i> BACK</button>
       <div class="button-container mt-4" id="btn-container">
        <button class="btn btn-primary ml-4" id="add-new-announcement">Add New</button>
        <button class="btn btn-info pull-right" id="past-ann-btn">View Announcements</button>
       </div>
      </div>
     </div>

     <div class="row" id="announcement-row">
      <div class="col-md-12 col-sm-12">
       <div class="card">
        <div class="card-header">
         <strong>Publish New Announcements</strong>
         <button class="pull-right text-danger" id="cancel-ann"><i class="fa fa-times" aria-hidden="true"></i></i></button>
        </div>
        <div class="card-body card-block">
         <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">

          <div class="row form-group">
           <div class="col col-md-3">
            <label for="text-input" class=" form-control-label">Announcement Heading</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="text" name="title-input" placeholder="Heading" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="email-input" class=" form-control-label">The Short Description</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="text" name="short-input" placeholder="Short Description" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="info-input" class=" form-control-label">Full Description</label>
           </div>
           <div class="col-12 col-md-9">
            <textarea type="text" name="info-input" placeholder="Full description" class="form-control"></textarea>
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="" class=" form-control-label">Image</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="file" name="image-input">
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
         add_announcement();
         ?>
        </div>
       </div>
      </div>
     </div>

     <div class="row" id="past-announcement">
      <div class="col-md-12">
       <div class="card">
        <div class="card-header">
         <strong>All Announcements</strong>
         <button class="pull-right text-danger" id="cancel-announ"><i class="fa fa-times"></i></i></button>
        </div>
        <div class="card-body card-block">
         <table class="table table-bordered table-striped table-danger">
          <thead>
           <tr>
            <th>Status</th>
            <th>Title</th>
            <th>Info</th>
            <th>Image</th>
            <th>Detail Info</th>
            <th>Delete</th>
            <th>Publish</th>
           </tr>
          </thead>
          <tbody>

           <?php
           read_announcements();
           ?>
          </tbody>
         </table>
        </div>
       </div>
      </div>
     </div>
     <div class="row mt-3">
      <div class="col-lg-12 col-md-12 alert alert-danger">
       <button class="text-primary" id="jobs-btn"><i class="zmdi zmdi-case"></i> Jobs</button>
       <div class="button-container mt-4" id="bttn-container">
        <button class="btn btn-primary ml-4" id="new-job-btn">Post New Job</button>
        <button class="btn btn-info pull-right" id="all-job-btn">View Jobs</button>
       </div>
      </div>
     </div>

     <div class="row" id="jobs-row">
      <div class="col-md-12 col-sm-12">
       <div class="card">
        <div class="card-header">
         <strong>Post New Job</strong>
         <button class="pull-right text-danger" id="cancel-job"><i class="fa fa-times"></i></i></button>
        </div>
        <div class="card-body card-block">
         <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">

          <div class="row form-group">
           <div class="col col-md-3">
            <label for="text-input" class=" form-control-label">Job Title</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="text" name="job-title" placeholder="Post" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="" class=" form-control-label">Short Description</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="text" name="job-short" placeholder="Short Description" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="info-input" class=" form-control-label">Requirements</label>
           </div>
           <div class="col-12 col-md-9">
            <textarea type="text" name="requirement" id="editor" placeholder="Requirements" class="form-control"></textarea>
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="" class=" form-control-label">Skills</label>
           </div>
           <div class="col-12 col-md-9">
            <textarea type="text" name="skills" id="editor" placeholder="Skills" class="form-control"></textarea>
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="" class=" form-control-label">Salary</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="text" name="salary" placeholder="Salary" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="" class=" form-control-label">Number of Positions</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="text" name="number" placeholder="number" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="" class=" form-control-label">Contact</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="tel" name="contact" placeholder="Contact" class="form-control">
           </div>
          </div>
          <div class="row form-group">
           <div class="col col-md-3">
            <label for="" class=" form-control-label">Any Image</label>
           </div>
           <div class="col-12 col-md-9">
            <input type="file" name="image-job" class="form-control">
           </div>
          </div>
          <div class="card-footer">
           <button type="submit" class="btn btn-primary btn-sm" name="job-submit">
            <i class="fa fa-dot-circle-o"></i> Submit
           </button>
           <button type="reset" class="btn btn-danger btn-sm" name="reset">
            <i class="fa fa-ban"></i> Reset
           </button>
          </div>
         </form>
         <?php
         add_jobs();
         ?>
        </div>
       </div>
      </div>
     </div>

     <div class="row" id="all-jobs-row">
      <div class="col-md-12">
       <div class="card">
        <div class="card-header">
         <strong>All Jobs </strong>
         <button class="pull-right text-danger" id="cancel-all-job"><i class="fa fa-times"></i></i></button>
        </div>
        <div class="card-body card-block">
         <table class="table table-bordered table-striped table-danger">
          <thead>
           <tr>
            <th>Status</th>
            <th>Job Post</th>
            <th>Info</th>
            <th>Salary</th>
            <th>Number</th>
            <th>Delete</th>
            <th>Publish</th>
            <th>UnPublish</th>
           </tr>
          </thead>
          <tbody>

           <?php
           read_jobs();
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
</div>
<script>
 const all = document.querySelectorAll('.au-message__item-inner');
 all.forEach(each => {
  each.addEventListener("mouseover", () => {
   each.style.background = "lightblue";
   each.style.cursor = "pointer";
  });
  each.addEventListener("mouseleave", () => {
   each.style.background = "";
  });
  each.addEventListener("click", (e) => {
   const id = e.target.lastChild.previousSibling.value;
   const msg_rep = e.target.children[2].value;
   const name_whole = e.target.firstChild.nextSibling.firstChild.nextSibling.textContent;
   const msg_whole = e.target.firstChild.nextSibling.firstChild.nextSibling.nextSibling.nextSibling.textContent;
   const dates = e.target.firstChild.nextSibling.nextSibling.nextSibling.firstChild.nextSibling.textContent;
   const msg = msg_whole.split(" ");
   const name = name_whole.split(" ")
   document.querySelector('.au-message_').style.display = "none";
   const div = document.createElement('div');
   div.className = "au-chat";
   div.innerHTML = `
           <div class="au-chat__title">
            <div class="au-chat-info">
             <span class="nick">
              <a href="#">${name[0]}</a>
             </span>
            </div>
           </div>
           <div class="au-chat__content">
            <div class="recei-mess-wrap">
             <span class="mess-time">${dates}</span>
             <div class="recei-mess__inner">
              <div class="avatar avatar--tiny">
               <i class="zmdi zmdi-male"></i>
              </div>
              <div class="recei-mess-list">
               <div class="recei-mess">${msg[1]}</div>
              </div>
             </div>
            </div>
            <div class="send-mess-wrap">
             <span class="mess-time">30 Sec ago</span>
             <div class="send-mess__inner">
              <div class="send-mess-list">
               <div class="send-mess">${msg_rep}</div>
              </div>
             </div>
            </div>
           </div>
           <div class="au-chat-textfield">
            <form class="au-form-icon" method="POST">
             <input class="au-input au-input--full au-input--h65" type="text" name="msg_name" placeholder="Type a message">
             <button class="au-input-icon" name="msg_submit" type="submit">
              <i class="zmdi zmdi-mail-send"></i>
             </button>
             <input type="hidden" name="id_get" id= "get-id" value="${id}">
            </form>
           </div>
   `;
   const parent = document.querySelector('.au-inbox-wrap.js-inbox-wrap');
   parent.insertAdjacentElement('afterbegin', div);
   document.getElementById('back-btn').addEventListener("click", () => {
    document.querySelector('.au-chat').style.display = "none";
    document.querySelector('.au-message_').style.display = "block";

   })

  });
 });

 const msgRow = document.getElementById('message-row');
 const backMsgBtn = document.getElementById('msg-back-btn');
 backMsgBtn.style.display = "none";
 msgRow.style.display = "none";
 const msgBtn = document.getElementById("message-btn");
 msgBtn.addEventListener("click", () => {
  msgRow.style.display = "block";
  backMsgBtn.style.display = "inline-block";
  backMsgBtn.addEventListener("click", () => {
   msgRow.style.display = "none";
   backMsgBtn.style.display = "none";
  })
 });
 const announcementBtn = document.getElementById('announcement-btn');
 const backAnnBtn = document.getElementById('announcement-back-btn');
 const announcementRow = document.getElementById('announcement-row');
 const addNewAnnouncement = document.getElementById('add-new-announcement');
 const cancelNewAnn = document.getElementById('cancel-ann');
 let btnContainer = document.getElementById('btn-container');
 const pastAnnouncementBtn = document.getElementById('past-ann-btn');
 const pastAnnouncementRow = document.getElementById('past-announcement');
 const cancelAllAnn = document.getElementById('cancel-announ');
 backAnnBtn.style.display = "none";
 announcementRow.style.display = "none";
 btnContainer.style.display = "none";
 pastAnnouncementRow.style.display = "none";
 announcementBtn.addEventListener('click', () => {
  if (btnContainer.style.display == "none") {
   btnContainer.style.display = "block";
  } else
   btnContainer.style.display = "none";
 })
 addNewAnnouncement.addEventListener("click", () => {
  announcementRow.style.display = "block";
  btnContainer.style.display = "none";
  cancelNewAnn.addEventListener("click", () => {
   announcementRow.style.display = "none";
  })
 });
 pastAnnouncementBtn.addEventListener("click", () => {
  pastAnnouncementRow.style.display = "block";
  btnContainer.style.display = "none";
  cancelAllAnn.addEventListener("click", () => {
   pastAnnouncementRow.style.display = "none";
  })
 });

 const jobBtn = document.getElementById('jobs-btn');
 const jobBtns = document.getElementById('bttn-container');
 const jobRow = document.getElementById('jobs-row');
 const newJobBtn = document.getElementById('new-job-btn');
 const allJobBtn = document.getElementById('all-job-btn');
 const cancelJob = document.getElementById('cancel-job');
 const allJobsRow = document.getElementById('all-jobs-row');
 const cancelAllJob = document.getElementById('cancel-all-job');
 jobBtns.style.display = "none";
 jobRow.style.display = "none";
 allJobsRow.style.display = "none";
 jobBtn.addEventListener("click", () => {
  if (jobBtns.style.display == "none") {
   jobBtns.style.display = "block";
  } else {
   jobBtns.style.display = "none";
  }
 });
 newJobBtn.addEventListener("click", () => {
  jobRow.style.display = "block";
  jobBtns.style.display = "none";
  cancelJob.addEventListener("click", () => {
   jobRow.style.display = "none";
  })
 });
 allJobBtn.addEventListener("click", () => {
  allJobsRow.style.display = "block";
  jobBtns.style.display = "none";
  cancelAllJob.addEventListener("click", () => {
   allJobsRow.style.display = "none";
  })
 });


 document.querySelectorAll('#editor').forEach(each => {
  ClassicEditor.create(each)
   .then(editor => {
    console.log(editor);
   })
   .catch(error => {
    console.error(error);
   });
 });
</script>

<?php include "./includes/footer.php" ?>