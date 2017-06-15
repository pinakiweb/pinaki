<?php
include './connect.php';
include './utils.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_email     = test_input($_POST["user_email"]);
    $user_password  = test_input($_POST["user_password"]);
	$encrypt_pass=md5($user_password);

    $sql = "SELECT * from users where email = '$user_email' AND password = '$encrypt_pass";
    $result = $conn->query($sql);

    if($result->num_rows > 0) {
        session_start();
        $_SESSION["user"] = $user_email;

        header('Location: ../profile.php');
    } else {
        header('Location: ../signIn.php?error=true');
    }
}
?>
