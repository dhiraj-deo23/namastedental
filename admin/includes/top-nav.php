        <header class="header-desktop">
         <div class="section__content section__content--p30">
          <div class="container-fluid">
           <div class="header-wrap">
            <form class="form-header" action="search.php" method="POST">
             <input class="au-input au-input--xl" type="text" name="search" placeholder="Search for appointments &amp; reports..." />
             <button class="au-btn--submit" name="search-submit" type="submit">
              <i class="zmdi zmdi-search"></i>
             </button>
            </form>
            <div class="header-button">
             <form action="" method="POST">
              <div class="noti-wrap">
               <div class="noti__item js-item-menu" id="make-read">
                <i class="zmdi zmdi-comment-more"></i>
                <span class="quantity notif_qun"><?php num_unread_messages(); ?></span>
                <div class="mess-dropdown js-dropdown">
                 <div class="mess__title">
                  <p>You have <?php num_unread_messages(); ?> new message</p>
                 </div>
                 <?php unread_messages_top(0) ?>
                 <?php unread_messages_top(1) ?>

                 <div class="mess__footer">
                  <a href="" id="view-msg-all">View all messages</a>
                 </div>
                </div>
               </div>
               <div class="noti__item js-item-menu" id="app-read">
                <i class="zmdi zmdi-notifications"></i>
                <span class="quantity notify_app"><?php num_new_appointments(); ?></span>
                <div class="notifi-dropdown js-dropdown">
                 <div class="notifi__title">
                  <p>You have <?php num_new_appointments(); ?> New Appointments</p>
                 </div>

                 <?php new_appointments(0, 15); ?>
                 <?php new_appointments(1, 3); ?>
                 <div class="notifi__footer">
                  <a href="appointment.php">All appointments</a>
                 </div>
                </div>
               </div>
              </div>
             </form>
             <div class="account-wrap">
              <div class="account-item clearfix js-item-menu">
               <?php
               $email = $_SESSION['email'];
               $sql = "SELECT * FROM users where email = '$email' ";
               $res = query($sql);
               $row = mysqli_fetch_assoc($res);
               $name = $row['fullname'];
               $sql2 = "SELECT * FROM team where email = '$email' ";
               $res2 = query($sql2);
               $row2 = mysqli_fetch_assoc($res2);
               $image = $row2['image'];
               ?>
               <div class="image">
                <img src="../images/<?php echo $image ?>" alt="image" />
               </div>
               <div class="content">
                <a class="js-acc-btn" href="#"><?php echo $name  ?></a>
               </div>
               <div class="account-dropdown js-dropdown">
                <div class="info clearfix">
                 <div class="image">
                  <a href="#">
                   <img src="../images/<?php echo $image ?>" alt="image" />
                  </a>
                 </div>
                 <div class="content">
                  <h5 class="name">
                   <a href="#"><?php echo $name  ?></a>
                  </h5>
                  <span class="email"><?php echo $email; ?></span>
                 </div>
                </div>
                <div class="account-dropdown__body">
                 <div class="account-dropdown__item">
                  <a href="profile.php">
                   <i class="zmdi zmdi-account"></i>Profile</a>
                 </div>
                 <div class="account-dropdown__item">
                  <a href="setting.php">
                   <i class="zmdi zmdi-settings"></i>Setting</a>
                 </div>
                </div>
                <div class="account-dropdown__footer">
                 <a href="logout.php">
                  <i class="zmdi zmdi-power"></i>Logout</a>
                </div>
               </div>
              </div>
             </div>
            </div>
           </div>
          </div>
         </div>
        </header>
        <script>
         document.getElementById('make-read').addEventListener("click", () => {
          document.querySelector('.quantity.notif_qun').textContent = "";
          document.querySelector('.noti__item .quantity').style.background = "transparent";

          var username = "fucker";
          $.ajax({
           url: 'fetch.php',
           method: 'get',
           data: {
            name: username
           },
           success: function(data) {},
           error: function(data) {
            alert("error");
           }
          });
         });

         const valNoti = document.querySelector('.quantity.notif_qun').textContent;
         if (valNoti == "0") {
          document.querySelector('.quantity.notif_qun').textContent = "";
          document.querySelector('.noti__item .quantity').style.background = "transparent";
         }

         document.getElementById('app-read').addEventListener("click", () => {
          document.querySelector('.quantity.notify_app').textContent = "";
          document.querySelector('.noti__item .quantity.notify_app').style.background = "transparent";

          var username = "sucker";
          $.ajax({
           url: 'fetch.php',
           method: 'get',
           data: {
            same: username
           },
           success: function(data) {},
           error: function(data) {
            alert("error");
           }
          });
         });

         const valApp = document.querySelector('.quantity.notify_app').textContent;
         if (valApp == "0") {
          document.querySelector('.quantity.notify_app').textContent = "";
          document.querySelector('.noti__item .quantity.notify_app').style.background = "transparent";
         }

         document.getElementById('view-msg-all').addEventListener("click", (e) => {
          e.preventDefault();
          window.scrollTo(0, 505);
         });
        </script>