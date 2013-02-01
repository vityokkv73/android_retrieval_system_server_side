<?php
session_start();
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $user = $_POST['username'];
    $password = $_POST['password'];

    $host = "localhost";
    $db_user = "root";
    $db_password = "1111";
    $connection = mysql_connect($host, $db_user, $db_password);
    if (!$connection) {
        exit;
    }
    mysql_select_db("deerhunter_scheme");
    $select_query = "SELECT _id FROM users WHERE username = \"" . $user . "\" AND password = \"" . md5($password) . "\"";

    $user_id = mysql_query($select_query);
    if ($user_id) {
        $row = mysql_fetch_array($user_id);
        if ($row) {
            $_SESSION['user_id'] = $row['_id'];
            mysql_close($connection);
            header('Location: main.php');
            exit;
        }
        mysql_close($connection);
    }
}
$_SESSION['error_message'] = 'The user with this login or/and password does not exist';
header('Location: index.php');
?>
