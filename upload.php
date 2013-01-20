<?php
include 'Packets/SMS.php';
include 'Packets/Call.php';
include 'Packets/Image.php';
include 'Packets/Location.php';
include 'Packets/Contact.php';
include 'Packets/PacketType.php';
include 'Packets/PacketHeader.php';
include 'Packets/DbProvider.php';

$filename = writeDataToTempFile();
$fp = fopen($filename, "rb");
$header = new PacketHeader($fp);
$dbProvider = new DbProvider();
$id = $dbProvider->findIdByIMEI($header->imei);
if (is_null($id))
{
    fclose($fp);
    unlink($filename);
    exit();
}
$inserted = FALSE;

switch ($header->dataType) {
    case PacketType::SMS: // sms
        $sms = new SMS($fp);
        $inserted = $dbProvider->writeSmsIntoDB($sms, $id);
        break;
    case PacketType::CALL: //call
        $call = new Call($fp);
        $inserted = $dbProvider->writeCallIntoDB($call, $id);
        break;
    case PacketType::IMAGE: //image
        $image = new Image($fp);
        $image->saveImage($id);
        $inserted = $dbProvider->writeImageIntoDB($image, $id);
        break;
    case PacketType::LOCATION: //location
        $location = new Location($fp);
        $inserted = $dbProvider->writeLocationIntoDB($location, $id);
        break;
    case PacketType::CONTACT: //contact
        $contact = new Contact($fp);
        $inserted = $dbProvider->writeContactIntoDB($contact, $id);
        break;
    default:
        echo "Not defined type of packet";
}
fclose($fp);
unlink($filename);

if ($inserted === TRUE)
    echo "Done";
else
    echo "Failed";

function writeDataToTempFile()
{
    $filename = "" . time() . mt_rand(0, 1000); // almost unique string :)
    $fileData = file_get_contents('php://input');
    $fhandle = fopen($filename, 'wb');
    fwrite($fhandle, $fileData);
    fclose($fhandle);
    return $filename;
}