<?php
include './connect.php';
include './utils.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email     = test_input($_POST['user_email']);
    $user_password  = test_input($_POST['user_password']);
    $user_password_confirmation = test_input($_POST['user_password_confirmation']);

    $uid = uniqid('S');
    $role = 3;

    if($user_password != $user_password_confirmation) {
        header("Location: ../signUp.php?error=pass_match");
        die();
    }
	$encrypt_pass=md5($user_password);

    $sql = "SELECT * from users where email = '$user_email'";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        header("Location: ../signUp.php?error=user_exists");
        die();
    }

    $sql = "INSERT INTO users(uid, email, password, role) values('$uid', '$user_email', '$encrypt_pass', $role)";

    if($conn->query($sql)) {
        session_start();
        $_SESSION["user"] = $user_email;
        header('Location: ../profile.php');
    } else {
        die("Connection failed" . $conn->connect_error);
    }
}
?>
