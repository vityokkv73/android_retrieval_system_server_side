<?php
session_start();
if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['fullname']) && !empty($_POST['imei'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $imei = $_POST['imei'];

    $host = "localhost";
    $db_user = "root";
    $db_password = "1111";
    $connection = mysql_connect($host, $db_user, $db_password);
    if (!$connection) {
        $_SESSION['registration_error_text'] = 123;
        header('Location: registration.php');
        exit;
    }
    mysql_select_db("deerhunter_scheme");
    $select_query = "SELECT _id FROM users WHERE username = \"" . $user . "\" ";
    $result = mysql_query($select_query);
    $user_id = mysql_fetch_array($result);
    if ($user_id) {
        $_SESSION['registration_error_text'] = 'Problem with registration';
        mysql_close($connection);
        header('Location: registration.php');
    }
    else{
        $md5_password = md5($password);
        $insert_query = "INSERT INTO users (username, fullname, password, imei) values (\"$user\", \"$fullname\", \"$md5_password\", \"$imei\" )";
        $q = mysql_query ($insert_query);
        if (!$q){
            $_SESSION['registration_error_text'] = 'Problem with registration';
            mysql_close($connection);
            header('Location: registration.php');
        }
        else{
            $q = mysql_query ($select_query);
            $row = mysql_fetch_array($q);
            $_SESSION['user_id'] = $row['_id'];
            mysql_close($connection);
            header('Location: main.php');
        }
    }
} else {
    $_SESSION['registration_error_text'] = 'Problem with registration';
    header('Location: registration.php');
}