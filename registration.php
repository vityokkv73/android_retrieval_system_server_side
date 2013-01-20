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
<div id="content">
    <div id="header">
        <h1>Welcome to the Android retrieval system</h1>
    </div>
    <div id="main">
        <div id="error_message">
            <?php
            if (!empty($_SESSION['registration_error_text'])){
                echo  $_SESSION['registration_error_text'];
                $_SESSION['registration_error_text'] = '';
            }
            ?>
        </div>
        <div id="text">
            Fill all of these fields with your personal data or <a id="login" href="index.php">login</a> on the site.
        </div>
        <br/>
        <form id='registration_form' action='try_register.php' method='post' accept-charset='UTF-8'>
            <fieldset >
                <legend>Registration form</legend>
                <input type='hidden' name='submitted' id='submitted' value='1'/>
                <br/>
                <label for='username' >User name:</label>
                <input type='text' name='username' id='username'  maxlength="50" />
                <br/>
                <br/>
                <label for='password' >Password:</label>
                <input type='password' name='password' id='password' maxlength="50" />
                <br/>
                <br/>
                <label for='fullname' >Full name:</label>
                <input type='text' name='fullname' id='fullname' maxlength="50" />
                <br/>
                <br/>
                <label for='imei' >Phone IMEI:</label>
                <input type='text' name='imei' id='imei' maxlength="50" />
                <br/>
                <br/>
                <input type='submit' name='Submit' value=' Register ' />
            </fieldset>
        </form>
    </div>
</div>
<div id="footer">
    <br/>
    Created by DeerHunter (Viktor Isakov), 2013
</div>
</body>
</html>