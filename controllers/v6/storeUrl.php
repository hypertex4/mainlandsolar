<?php
    session_start();
    $_SESSION['USER_LOGIN']['oldUrl'] = "true";
    $_SESSION['user_login_temp']['temp_fname'] = $_POST['firstname'];
    $_SESSION['user_login_temp']['temp_lname'] = $_POST['lastname'];
    $_SESSION['user_login_temp']['temp_email'] = $_POST['email'];
    $_SESSION['user_login_temp']['temp_phone'] = $_POST['phone'];
    $_SESSION['user_login_temp']['temp_add'] = $_POST['address'];
    $_SESSION['user_login_temp']['temp_state'] = $_POST['state'];
?>
