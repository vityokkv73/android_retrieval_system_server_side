<?php
include_once 'Packet.php';
class SMS extends Packet
{
    var $sender;
    var $sender_number;
    var $recipient;
    var $recipient_number;
    var $time;
    var $text;

    function SMS($stream)
    {
        $this->sender = $this->readString($stream);

        $this->recipient = $this->readString($stream);

        $this->sender_number = $this->readString($stream);

        $this->recipient_number = $this->readString($stream);

        $this->time = $this->readLong($stream);

        $this->text = $this->readString($stream);
    }
}
