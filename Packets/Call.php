<?php
include 'Packet.php';
class Call extends Packet
{
    var $caller;
    var $caller_number;
    var $recipient;
    var $recipient_number;
    var $time;

    function Call($stream)
    {
        $this->caller = $this->readString($stream);

        $this->recipient = $this->readString($stream);

        $this->caller_number = $this->readString($stream);

        $this->recipient_number = $this->readString($stream);

        $this->time = $this->readLong($stream);
    }
}
