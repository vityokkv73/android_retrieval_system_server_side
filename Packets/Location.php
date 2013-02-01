<?php
include_once 'Packet.php';
class Location extends Packet
{
    var $latitude;
    var $longitude;
    var $altitude;
    var $accuracy;
    var $provider;
    var $time;

    function Location($stream)
    {
        $this->latitude = $this->readDouble($stream);

        $this->longitude = $this->readDouble($stream);

        $this->altitude = $this->readDouble($stream);

        $this->accuracy = $this->readFloat($stream);

        $this->provider = $this->readString($stream);

        $this->time = $this->readLong($stream);
    }
}