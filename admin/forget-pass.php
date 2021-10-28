<?php include "./includes/header.php" ?>

<div class="page-wrapper">
    <div class="page-content--bge5">
        <div class="container">
            <div class="login-wrap">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="#">
                            <img src="images/icon/logo.png" alt="CoolAdmin">
                        </a>
                    </div>
                    <div class="login-form">
                        <form action="" method="post">
                            <div class="form-group">
                                <label>Email Address</label>
                                <input class="au-input au-input--full" type="email" name="email" placeholder="Email">
                            </div>
                            <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="reset-submit">submit</button>
                        </form>
                        <?php
                        if (isset($_POST['reset-submit'])) {
                            if (isset($_POST['email'])) {
                                $email = $_POST['email'];
                                forgot_password($email);
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include "./includes/footer.php" ?>