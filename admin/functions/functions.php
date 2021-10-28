<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use function PHPSTORM_META\type;

require '/wamp64/www/Namaste/vendor/autoload.php';


function send_email($email, $subject, $message)
{
    $mail = new PHPMailer(true);
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = '';
    $mail->SMTPAuth   = true;
    $mail->Username   = '';
    $mail->Password   = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587; //465
    $mail->setFrom('...', 'Namaste Dental');
    $mail->addAddress($email);

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = $message;

    if (!$mail->send()) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


function redirect($result)
{
    return header("location: {$result}");
}

function set_message($message)
{
    if (!empty($message)) {
        $_SESSION['message'] = $message;
    } else {
        $message = "";
    }
}

function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}


function username_exist($username)
{

    $sql = "SELECT * FROM users where username = '$username' ";
    $result = query($sql);
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    return $username;
}

function email_exist($email)
{

    $sql = "SELECT * FROM users where email = '$email' ";
    $result = query($sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    return $email;
}

function mail_exist($email)
{

    $sql = "SELECT * FROM team where email = '$email' ";
    $result = query($sql);
    $row = mysqli_fetch_assoc($result);
    $email = $row['email'];
    return $email;
}

function clean($resullt)
{
    return htmlentities($resullt);
}


function register_user($fullname, $username, $email, $password)
{
    $fullname = escape($fullname);
    $username = escape($username);
    $email = escape($email);
    $password = escape($password);

    if ($username !== username_exist($username) && $email !== email_exist($email)) {
        if ($username !== $email) {
            $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));
            $validation = md5($username . microtime());

            $sql = "INSERT INTO users(username, fullname, email, password, validation, active) VALUES('$username', '$fullname', '$email', '$password', '$validation', '0')";
            $register_query = query($sql);
            confirm($register_query);
            echo "user registered";

            $subject = "Activate Your Account";
            $message = "Please click on the link below to activate your account
https://localhost/namaste/admin/activate.php?validation=$validation&email=$email


";

            send_email($email, $subject, $message);

            set_message("Go to your email to activate your account");
            redirect("./index.php");
        } else {
            echo "sorry, username shouldn't match email or phone";
        }
    } else {
        echo "'$username' or $email is already taken";
    }
}


function login($email, $password, $remember)
{


    $sql = "SELECT * FROM users WHERE email = '$email' AND active = 1";
    $result = query($sql);
    $row = mysqli_fetch_assoc($result);
    $pass = $row['password'];
    $remember = clean($remember);
    if (password_verify($password, $pass)) {
        redirect("index.php");
        if ($remember = 'on') {
            setcookie('email', $email, time() + 60 * 60 * 24);
        }
        $_SESSION['email'] = $email;
    } else {
        set_message("<p class='bg-danger text-center'>Login credentials mismatch</p>");
        redirect("login.php");
    }
}

function logged_in()
{

    if (isset($_SESSION['email']) || isset($_COOKIE['email'])) {
        return true;
    } else {
        return false;
    }
}

function forgot_password($email)
{
    $sql = "SELECT * FROM users WHERE email = '$email' AND active = 1";
    $result = query($sql);
    if (row_count($result) === 1) {
        $validating_code = rand(1999, 9999);
        setcookie('validcode', $validating_code, time() + 60 * 60 * 24 * 3);
        setcookie('mail', $email, time() + 60 * 60 * 24 * 3);
        $subject = "Reset your password";
        $message = "Please click on this link below

        <a class='btn btn-primary' href='http://localhost/namaste/admin/code.php'>Reset</a>

        And enter the code: $validating_code
        ";
        send_email($email, $subject, $message);
        set_message("we have sent code to $email");
        echo "Check your mail";
        redirect("code.php");
    } else {
        redirect("../index.php");
    }
}

function validate_code()
{
    if (isset($_COOKIE['validcode'])) {
        if (isset($_POST['submit'])) {
            if (!empty($_POST['code'])) {
                if ($_COOKIE['validcode'] === $_POST['code']) {
                    redirect("reset-pass.php");
                    unset($_COOKIE['validcode']);
                    setcookie('validcode', '', time() - 60 * 60 * 24 * 3);
                    $_SESSION['secure'] = "whatever";
                }
            }
        }
    }
}

function recover_password()
{
    if (isset($_COOKIE['mail']) || logged_in()) {
        isset($_COOKIE['mail']) ? $email = $_COOKIE['mail'] : $email =
            $_SESSION['email'];
        $sql = "SELECT * FROM users WHERE email = '$email' AND active = 1";
        $result = query($sql);
        if (row_count($result) === 1) {
            if (isset($_POST['recov-submit'])) {
                if (isset($_POST['password']) && isset($_POST['c-password'])) {
                    $pass = escape($_POST['password']);
                    $cpass = escape($_POST['c-password']);
                    if ($pass === $cpass) {
                        $password = password_hash($pass, PASSWORD_BCRYPT, array('cost' => 12));
                        $sql2 = "UPDATE users SET password = '$password' where email = '$email' ";
                        $res2 = query($sql2);
                        unset($_COOKIE['mail']);
                        setcookie('mail', '', time() - 60 * 60 * 24 * 3);
                        redirect("logout.php");
                    } else {
                        echo "passwords didn't match";
                    }
                }
            }
        }
    } else {
        echo "cookies expired. please try again.";
    }
}

// appointment

function appointments($date)
{
    $query = "SELECT * FROM appointment where date_appointment = '$date' order by time_appointment ";
    $res = query($query);
    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['appointment_id'];
        $name = $row['name'];
        $time = $row['time_appointment'];
        $neworex = $row['previous_checkup'];
        $details = $row['reason'];
        echo "<tr>";
        echo "<td>$time</td>";
        echo "<td>$id</td>";
        echo "<td>$name</td>";
        echo "<td>$neworex</td>";
        echo "<td>$details</td>";
        echo "</tr>";
    }
}


function process_appointment($date_now, $inp_date)
{
    $query = "SELECT * FROM appointment order by date_appointment ";
    $res = query($query);
    while ($row = mysqli_fetch_assoc($res)) {
        $date = $row['date_appointment'];
        $date_app = new DateTime("$date");
        if ($date_app >= $date_now && $date_app < $inp_date) {
            $id = $row['appointment_id'];
            $name = $row['name'];
            $gender = $row['gender'];
            $phone = $row['phone'];
            $status = $row['status'];
            $time = $row['time_appointment'];
            $date1 = date_create_from_format("Y-m-d", "$date");
            $date_dis = date_format($date1, "jS M");
            $day = date_format($date1, "D");
            echo "<tr>";
            echo "<td>
               <label class='au-checkbox'>
               <input type='checkbox' id='selectfield' name='checkbox[]' value='$id'>
               <span class='au-checkmark'></span>
               </label>
              </td>";
            echo "<td>$date_dis</td>";
            echo "<td><span class='block-email'>$day</span></td>";
            echo "<td>$name</td>";
            echo "<td>$gender</td>";
            echo "<td>$phone</td>";
            echo "<td class='desc'>$status</td>";
            echo "<td><button type='button' id='add_description' name='addbox[]' value='$id' class='btn btn-primary'>Add</button></td>";
            echo "</tr>";
        }
    }
}

function descriptions()
{
    $query = "SELECT * FROM appointment where status = 'processed' AND description != '' order by date_appointment DESC";
    $res = query($query);
    $today = new DateTime("today");
    while ($row = mysqli_fetch_assoc($res)) {
        $date = $row['date_appointment'];
        $dates = new DateTime("$date");
        if ($dates <= $today) {
            $id = $row['appointment_id'];
            $name = $row['name'];
            $phone = $row['phone'];
            $description = $row['description'];
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$date</td>";
            echo "<td>$name</td>";
            echo "<td>$phone</td>";
            echo "<td>$description</td>";
            echo "</tr>";
        }
    }
}

// dashboard

function count_app($date)
{
    $sql = "SELECT * FROM appointment where date_appointment = '$date' ";
    $res = query($sql);
    $num = row_count($res);
    echo $num;
}

function count_app2()
{
    $date = date("Y-m-d");
    $sql = "SELECT * FROM appointment where date_appointment >= '$date' ";
    $res = query($sql);
    $num = row_count($res);
    echo $num;
}

function count_week()
{
    $day = date("N");
    $add = 6 - $day;
    $date = new DateTime("today");
    date_add($date, date_interval_create_from_date_string("$add days"));
    $date_week = $date->format("Y-m-d");
    $date_today = date("Y-m-d");
    $sql = "SELECT * FROM appointment where date_appointment >= '$date_today' and date_appointment <= '$date_week' ";
    $res = query($sql);
    $num = row_count($res);
    echo $num;
}


function add_task()
{
    $task = $_POST['task_input'];
    $time = $_POST['time_input'];
    $date = $_POST['task_date'];
    $urgent = $_POST['urgent'];
    if (!empty($task) && !empty($time)) {
        $sql = "INSERT INTO tasks(task, time, date, urgent) VALUES('$task', '$time', '$date', '$urgent' ) ";
        $res = query($sql);
    }
}

function receive_task()
{
    $date = date("Y-m-d");
    $sql = "SELECT * FROM tasks where date = '$date' order by time ";
    $res = query($sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $task = $row['task'];
        $time = $row['time'];
        $urgent = $row['urgent'];
        $urgent == "on" ? $urg = "urgent" : $urg = "";
        $result = <<<EOT
<div class="au-task__item-inner" id="child_task">
              <h5 class="task">
               <a href="#">$task</a>
              </h5>
              <span class="time">$time</span>
              <span class="pull-right text-danger"><small><em>$urg</em></small></span>
             </div>
EOT;
        echo $result;
    }
}

function num_unread_messages()
{
    $sql = "SELECT * FROM message where status = 0 order by date DESC ";
    $res = query($sql);
    $count = row_count($res);
    echo $count;
}

function unread_messages()
{



    $sql = "SELECT * FROM message order by date DESC ";
    $res = query($sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['message_id'];
        $name = $row['name'];
        $subject = $row['subject'];
        $email = $row['email'];
        $msg = $row['message_text'];
        $reply = $row['reply'];
        $date = $row['date'];
        $difference = date_diff(new DateTime("$date", timezone_open("Asia/Kathmandu")), new DateTime("now", timezone_open("Asia/Kathmandu")));
        $diff_day = $difference->format("%a");
        if ($diff_day > 0) {
            $diff_day = $diff_day . " Days Ago";
        } else {
            $diff_hr = $difference->format("%H");
            if ($diff_hr > 0) {
                $diff_hr = $diff_hr . " Hours Ago";
                $diff_day = $diff_hr;
            } else {
                $diff_min = $difference->format("%i");
                if ($diff_min > 0) {
                    $diff_min = $diff_min . " Mins Ago";
                    $diff_day = $diff_min;
                } else {
                    $diff_secs = $difference->format("%s");
                    $diff_secs = $diff_secs . " Secs Ago";
                    $diff_day = $diff_secs;
                }
            }
        }


        $result = <<<EOT
             <div class="au-message__item-inner">
             <div class="text">
             <h5 class="name text-info">$name (Subject: $subject)</h5>
             <p>Msg: $msg</p>
             </div>
             <div class="au-message__item-time">
             <span class="text-danger">$diff_day</span>
             </div>
             <input type="hidden" value="$reply">
             <input type="hidden" value="$id">
              </div>
EOT;
        echo $result;
    }
}

function unread_messages_top($n)
{
    $sql = "SELECT * FROM message where status = $n order by date DESC LIMIT 3";
    $res = query($sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['message_id'];
        $name = $row['name'];
        $subject = $row['subject'];
        $date = $row['date'];
        $difference = date_diff(new DateTime("$date", timezone_open("Asia/Kathmandu")), new DateTime("now", timezone_open("Asia/Kathmandu")));
        $diff_day = $difference->format("%a");
        if ($diff_day > 0) {
            $diff_day = $diff_day . " Days Ago";
        } else {
            $diff_hr = $difference->format("%H");
            if ($diff_hr > 0) {
                $diff_hr = $diff_hr . " Hours Ago";
                $diff_day = $diff_hr;
            } else {
                $diff_min = $difference->format("%i");
                if ($diff_min > 0) {
                    $diff_min = $diff_min . " Mins Ago";
                    $diff_day = $diff_min;
                } else {
                    $diff_secs = $difference->format("%s");
                    $diff_secs = $diff_secs . " Secs Ago";
                    $diff_day = $diff_secs;
                }
            }
        }
        $n == 0 ? $bg = "bg-info" : $bg = "";
        $n == 0 ? $icon = "email" : $icon = "email-open";
        $result = <<<EOT
             <div class="notifi__item $bg">
              <div class="bg-c1 img-cir img-40">
               <i class="zmdi zmdi-$icon"></i>
              </div>
              <div class="content">
               <h6>$name</h6>
               <p>Have sent a Message regarding $subject</p>
               <span class="time">$diff_day</span>
              </div>
             </div>
             <input type="hidden" name="id_get" id= "get-id" value="$id">
EOT;
        echo $result;
    }
}

function num_new_appointments()
{
    $sql = "SELECT * FROM appointment where notify = 0 order by date_request DESC ";
    $res = query($sql);
    $count = row_count($res);
    echo $count;
}

function new_appointments($n, $m)
{
    $sql = "SELECT * FROM appointment where notify = $n order by date_request DESC LIMIT $m";
    $res = query($sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $name = $row['name'];
        $age = $row['age'];
        $gender = $row['gender'];
        $reason = $row['reason'];
        $date = $row['date_appointment'];
        $date_req = $row['date_request'];
        $gender == "male" ? $genders = "M" : $genders = "F";
        $date = new DateTime($date);
        $date_req = new DateTime($date_req);
        $date = $date->format("dS M");
        $date_req = $date_req->format("dS M D");
        $n == 0 ? $new = "new" : $new = "";
        $n == 0 ? $bg = "bg-info" : $bg = "";
        $result = <<<EOT
                 <div class="notifi__item $bg">
                  <div class="bg-c1 img-cir img-40">
                  <i class="zmdi zmdi-$gender"></i>
                  </div>
                  <div class="content">
                  <p>$name($age/$genders) booked an appointment for $date</p>
                   <span class="date">$date_req</span>
                   <span class="pull-right text-danger">$new</span>
                  </div>
                 </div>
EOT;
        echo $result;
    }
}

// announcements

function add_announcement()
{
    if (isset($_POST['submit'])) {
        $title = escape(clean($_POST['title-input']));
        $short = escape(clean($_POST['short-input']));
        $info = escape(clean($_POST['info-input']));
        $image = $_FILES['image-input']['tmp_name'];
        $name = basename($_FILES['image-input']['name']);
        move_uploaded_file($image, "../images/$name");
        $active = 1;
        $sql = "INSERT INTO announcements(heading, short_desc, image, full_desc, active) VALUES ('{$title}', '{$short}', '{$name}', '$info', $active) ";
        $res = query($sql);
        if ($res) {
            $sql2 = "UPDATE announcements SET active = 0 WHERE id != LAST_INSERT_ID() ";
            $res2 = query($sql2);
        }
    }
}

function read_announcements()
{
    $sql = "SELECT * FROM announcements order by id DESC ";
    $res = query($sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $active = $row['active'];
        $title = $row['heading'];
        $info = $row['short_desc'];
        $image = $row['image'];
        $id = $row['id'];
        $detail = $row['full_desc'];
        $active == 1 ? $status = "Active" : $status = "OLD";
        $status == "Active" ? $color = "btn-danger" : $color = "btn-info";
        echo "<tr>";
        echo "<td><button class='btn $color'>$status</button></td>";
        echo "<td>$title</td>";
        echo "<td>$info</td>";
        echo "<td><img src='../images/$image' alt='facility-image'></td>";
        echo "<td>$detail</td>";
        echo "<td><a class='btn btn-primary btn-block mt-2' href='announcement.php?delete=$id'>Delete</a></td>";
        echo "<td><a class='btn btn-primary btn-block mt-2' href='announcement.php?publish=$id'>Publish</a></td>";
        echo "</tr>";
    }
}

// jobs

function add_jobs()
{
    if (isset($_POST['job-submit'])) {
        $title = escape(clean($_POST['job-title']));
        $short = escape(clean($_POST['job-short']));
        $requirement = escape(clean($_POST['requirement']));
        $skills = escape(clean($_POST['skills']));
        $salary = escape(clean($_POST['salary']));
        $number = escape(clean($_POST['number']));
        $contact = escape(clean($_POST['contact']));
        $image = $_FILES['image-job']['tmp_name'];
        $name = basename($_FILES['image-job']['name']);
        move_uploaded_file($image, "../images/$name");
        $active = 1;
        $sql = "INSERT INTO jobs(job_post, job_content, requirements, skills, salary, number, contact, image, active) VALUES ('{$title}', '{$short}', '{$requirement}', '$skills', '$salary', '$number', '$contact', '$name', $active) ";
        $res = query($sql);
        if ($res) {
            $sql2 = "UPDATE jobs SET active = 0 WHERE id != LAST_INSERT_ID() ";
            $res2 = query($sql2);
        }
    }
}

function read_jobs()
{
    $sql = "SELECT * FROM jobs order by id DESC ";
    $res = query($sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $active = $row['active'];
        $title = $row['job_post'];
        $info = $row['job_content'];
        $id = $row['id'];
        $salary = $row['salary'];
        $number = $row['number'];
        $active == 1 ? $status = "Active" : $status = "IDLE";
        $status == "Active" ? $color = "btn-danger" : $color = "btn-info";
        echo "<tr>";
        echo "<td><button class='btn $color'>$status</button></td>";
        echo "<td>$title</td>";
        echo "<td>$info</td>";
        echo "<td>$salary</td>";
        echo "<td>$number</td>";
        echo "<td><a class='btn btn-primary btn-block mt-2' href='announcement.php?del_job=$id'>Delete</a></td>";
        echo "<td><a class='btn btn-primary btn-block mt-2' href='announcement.php?pub_job=$id'>Publish</a></td>";
        echo "<td><a class='btn btn-primary btn-block mt-2' href='announcement.php?unpublish=$id'>UnPublish</a></td>";
        echo "</tr>";
    }
}
