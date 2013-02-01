<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
    <title>Welcome to the Android retrieval system</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
<div id="container">
    <div id="header">
        <h1>Welcome to the Android retrieval system</h1>
    </div>
    <div id="main">
        <div id="error_text">
            <?php
            if (!empty($_SESSION['error_message'])) {
                echo $_SESSION['error_message'];
                $_SESSION['error_message'] = '';
            }
            ?>
        </div>
        <div id="text">
            Login or <a id="register" href="registration.php">register</a> on the site.
        </div>
        <br/>

        <form id='login_form' action='login.php' method='post' accept-charset='UTF-8'>
            <fieldset>
                <legend>Login</legend>
                <input type='hidden' name='submitted' id='submitted' value='1'/>
                <br/>
                <label for='username'>UserName:</label>
                <input type='text' name='username' id='username' maxlength="50"/>
                <br/>
                <br/>
                <label for='password'>Password:</label>
                <input type='password' name='password' id='password' maxlength="50"/>
                <br/>
                <br/>
                <input type='submit' name='Submit' value=' Log in '/>
            </fieldset>
        </form>
    </div>
    <div id="dummy">
    </div>
    <div id="footer">
        <br/>
        Created by DeerHunter (Viktor Isakov), 2013
    </div>
</div>
</body>
</html>