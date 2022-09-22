<?php session_start();
include_once ('../controllers/classes/Admin.class.php');
$msg='';
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']['STATUS'] == 200) header('Location:dashboard');
if (isset($_POST['submit']) & !empty($_POST)) {
    $username = mysqli_real_escape_string($admin->conn, $_POST['username']);
    $password = mysqli_real_escape_string($admin->conn, $_POST['password']);
    $sql = "select * from tbl_admin_users where admin_username='$username' AND admin_password=md5('$password')";
    $res = mysqli_query($admin->conn,$sql);
    $count = mysqli_num_rows($res);
    if ($count> 0){
        $_SESSION['ADMIN_LOGIN'] = array('STATUS' => 200, 'ADMIN_USERNAME' => $username);
        header('Location:dashboard');
    } else {
        $msg = "Invalid credentials, try again (incorrect email/password)";
    }
}
?>
<!doctype html>
<html class="no-js" lang="">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login: Mainland Solar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/style_index.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
        input.form-control,.custom-select{border-radius: 0}
        .custom-select:focus,
        textarea:focus,
        textarea.form-control:focus,
        input.form-control:focus,
        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus,
        input[type=number]:focus,
        [type=text].form-control:focus,
        [type=password].form-control:focus,
        [type=email].form-control:focus,
        [type=tel].form-control:focus,
        [contenteditable].form-control:focus {
            box-shadow: inset 0 -1px 0 #ddd;
        }
    </style>
</head>
<body class="my-bg">
<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-form mt-150">
                <div class="text-center" style="width: 30%;margin: 0 auto;"><img src="assets/img/favicon.png" alt=""></div>
                <form method="post">
                    <div class="form-group mt-5">
                        <input type="text" class="form-control" placeholder="Enter Username" name="username" required aria-label="">
                    </div>
                    <div class="form-group mt-4">
                        <input type="password" class="form-control" placeholder="Enter Password" name="password" required aria-label="">
                    </div>
                    <button type="submit" name="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
                </form>
                <div class="field_error"><?php echo $msg; ?></div>
            </div>
        </div>
    </div>
</div>

</body>
</html>