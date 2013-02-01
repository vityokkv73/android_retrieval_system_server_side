<?php
class DbProvider
{
    const HOST = "localhost";
    const USER_NAME = "root";
    const PASSWORD = "1111";
    const DATABASE_NAME = "deerhunter_scheme";

    function findIdByIMEI($imei)
    {
        if (!mysql_connect(DbProvider::HOST, DbProvider::USER_NAME, DbProvider::PASSWORD)) {
            return NULL;
        }

        mysql_select_db(DbProvider::DATABASE_NAME);

        $q = mysql_query("SELECT _id FROM users WHERE imei = \"$imei\" ");
        if (!$q) {
            return NULL;
        }

        $result = mysql_fetch_array($q);
        if (!$result) {
            return NULL;
        }

        return $result['_id'];
    }

    function writeSmsIntoDB(&$sms, $id)
    {
        if (!mysql_connect(DbProvider::HOST, DbProvider::USER_NAME, DbProvider::PASSWORD)) {
            return NULL;
        }

        mysql_select_db(DbProvider::DATABASE_NAME);

        return mysql_query("INSERT INTO sms (sender, recipient, sender_phone_number, recipient_phone_number, time, sms_body, user_id) values
                          ( \"$sms->sender\", \"$sms->recipient\" , \"$sms->sender_number\" , \"$sms->recipient_number\", FROM_UNIXTIME($sms->time) , \"$sms->text\", $id) ");
    }

    function writeCallIntoDB(&$call, $id)
    {
        if (!mysql_connect(DbProvider::HOST, DbProvider::USER_NAME, DbProvider::PASSWORD)) {
            return NULL;
        }

        mysql_select_db(DbProvider::DATABASE_NAME);

        return mysql_query("INSERT INTO calls (caller, recipient, caller_phone_number, recipient_phone_number, time, user_id) values
                          ( \"$call->caller\", \"$call->recipient\" , \"$call->caller_number\" , \"$call->recipient_number\", FROM_UNIXTIME($call->time) ,  $id) ");
    }

    function writeImageIntoDB(&$image, $id)
    {
        if (!mysql_connect(DbProvider::HOST, DbProvider::USER_NAME, DbProvider::PASSWORD)) {
            return NULL;
        }

        mysql_select_db(DbProvider::DATABASE_NAME);

        return mysql_query("INSERT INTO image_thumbnails (display_name, file_path, store_id, local_file_path, date_added, user_id)
                   values ( \"$image->display_name\", \"$image->file_path\" , $image->store_id, \"$image->local_file_path\", FROM_UNIXTIME($image->time), $id) ");
    }

    function writeLocationIntoDB(&$location, $id)
    {
        if (!mysql_connect(DbProvider::HOST, DbProvider::USER_NAME, DbProvider::PASSWORD)) {
            return NULL;
        }

        mysql_select_db(DbProvider::DATABASE_NAME);

        return mysql_query("INSERT INTO locations (latitude, longitude, altitude, accuracy, provider, time, user_id)
                   values ($location->latitude, $location->longitude, $location->altitude, $location->accuracy, \"$location->provider\", FROM_UNIXTIME($location->time), $id) ");
    }

    function writeContactIntoDB(&$contact, $id)
    {
        if (!mysql_connect(DbProvider::HOST, DbProvider::USER_NAME, DbProvider::PASSWORD)) {
            return NULL;
        }

        mysql_select_db(DbProvider::DATABASE_NAME);

        return mysql_query("INSERT INTO contacts (contact_id, display_name, phones, emails, notes, addresses, im_addresses, organization, user_id)
                   values ($contact->contact_id, \"$contact->displayName\", \"$contact->phones\", \"$contact->emails\", \"$contact->notes\", \"$contact->addresses\", \"$contact->imAddresses\", \"$contact->organization\", $id) ");
    }
}
