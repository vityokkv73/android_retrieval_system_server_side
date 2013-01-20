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
    <br/>

    <div id="main">
        <form id="selection_form" method="post">
            <fieldset>
                <legend>Choose the activity you want to see</legend>
                <br>
                <input type="checkbox" name="activity_type[]" value="call">Calls
                <input type="checkbox" name="activity_type[]" value="sms">SMS
                <input type="checkbox" name="activity_type[]" value="contact">Contacts
                <input type="checkbox" name="activity_type[]" value="location">Locations
                <input type="checkbox" name="activity_type[]" value="image">Images
                <input type="submit" value=" Update ">
                <br>
            </fieldset>
        </form>
        <br/>
        <br/>
        <?php
        $user_id = $_SESSION['user_id'];
        $types = $_POST['activity_type'];
        if (!empty($types) && !empty($user_id)) {
            $host = "localhost";
            $user = "deerhunter";
            $password = "aceraspire4920g";
            $connection = mysql_connect($host, $user, $password);
            if (!$connection) {
                exit;
            }

            mysql_select_db("deerhunter_scheme");

            if (in_array('call', $types)) {
                echo "<h2>Calls</h2><br/>";
                echo "<table id='calls_table' width=100% border=1>";
                echo "<tr><th>Caller</th><th>Caller number</th><th>Recipient</th><th>Recipient number</th><th>Time</th></tr>";
                $select_query = "SELECT * FROM calls WHERE user_id = " . $user_id;
                // var_dump($select_query);
                $result = mysql_query($select_query);
                if ($result) {
                    while ($row = mysql_fetch_array($result)) {
                        $timestamp = strtotime("$row[time]");
                        $date_time = date('d-m-Y H:i:s', $timestamp);
                        echo "<tr><td>$row[caller]</td><td>$row[caller_phone_number]</td><td>$row[recipient]</td><td>$row[recipient_phone_number]</td><td>$date_time</td></tr>";
                    }
                    echo "</table><br/>";
                }
            }

            if (in_array('sms', $types)) {
                echo "<h2>SMS</h2><br/>";
                echo "<table id='sms_table' width=100% border=1>";
                echo "<tr><th>Sender</th><th>Sender number</th><th>Recipient</th><th>Recipient number</th><th>Time</th><th style='width: 50%'>SMS</th></tr>";
                $select_query = "SELECT * FROM sms WHERE user_id = " . $user_id;
                // var_dump($select_query);
                $result = mysql_query($select_query);
                if ($result) {
                    while ($row = mysql_fetch_array($result)) {
                        $timestamp = strtotime("$row[time]");
                        $date_time = date('d-m-Y H:i:s', $timestamp);
                        echo "<tr><td>$row[sender]</td><td>$row[sender_phone_number]</td><td>$row[recipient]</td><td>$row[recipient_phone_number]</td><td>$date_time</td><td>$row[sms_body]</td></tr>";
                    }
                    echo "</table><br/>";
                }
            }

            if (in_array('contact', $types)) {
                echo "<h2>Contacts</h2><br/>";
                echo "<table id='contacts_table' width=100% border=1>";
                echo "<tr><th>Name</th><th>Phone numbers</th><th>Emails</th><th>Notes</th><th>Addresses</th><th>IM addresses</th><th>Organization</th></tr>";
                $select_query = "SELECT * FROM contacts WHERE user_id = " . $user_id;
                // var_dump($select_query);
                $result = mysql_query($select_query);
                if ($result) {
                    while ($row = mysql_fetch_array($result)) {
                        echo "<tr><td>$row[display_name]</td><td>$row[phones]</td><td>$row[emails]</td><td>$row[notes]</td><td>$row[addresses]</td><td>$row[im_addresses]</td><td>$row[organization]</td></tr>";
                    }
                    echo "</table><br/>";
                }
            }

            if (in_array('location', $types)) {
                echo "<h2>Locations</h2><br/>";
                echo "<table id='locations_table' width=100% border=1>";
                echo "<tr><th>Latitude</th><th>Longitude</th><th>Altitude</th><th>Accuracy</th><th>Provider</th><th>Time</th></tr>";
                $select_query = "SELECT * FROM locations WHERE user_id = " . $user_id;
                // var_dump($select_query);
                $result = mysql_query($select_query);
                if ($result) {
                    while ($row = mysql_fetch_array($result)) {
                        $timestamp = strtotime("$row[time]");
                        $date_time = date('d-m-Y H:i:s', $timestamp);
                        echo "<tr><td>$row[latitude]</td><td>$row[longitude]</td><td>$row[altitude]</td><td>$row[accuracy]</td><td>$row[provider]</td><td>$date_time</td></tr>";
                    }
                    echo "</table><br/>";
                }
            }

            if (in_array('image', $types)) {
                echo "<h2>Images</h2><br/>";
                echo "<table id='images_table' width=100% border=1>";
                echo "<tr><th>Image name</th><th>Path to the image</th><th>Created date</th><th>Image</th></tr>";
                $select_query = "SELECT * FROM image_thumbnails WHERE user_id = " . $user_id;
                // var_dump($select_query);
                $result = mysql_query($select_query);
                if ($result) {
                    while ($row = mysql_fetch_array($result)) {
                        $path_to_image = $row['local_file_path'];
                        echo "<tr><td>$row[display_name]</td><td>$row[file_path]</td><td>$row[date_added]</td><td><img src='$path_to_image'></td></tr>";
                    }
                    echo "</table><br/>";
                }
            }

            mysql_close($connection);
        }
        ?>
    </div>
</div>
<div id="footer">
    <br/>
    Created by DeerHunter (Viktor Isakov), 2013
</div>
</body>
</html>