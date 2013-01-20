<?php
include 'Packet.php';
class Contact extends Packet
{
    var $contact_id;
    var $displayName;
    var $phones;
    var $emails;
    var $notes;
    var $addresses;
    var $imAddresses;
    var $organization;

    function Contact($stream)
    {
        $this->contact_id = $this->readInt($stream);

        $this->displayName = $this->readString($stream);

        $this->phones = $this->readString($stream);

        $this->emails = $this->readString($stream);

        $this->notes = $this->readString($stream);

        $this->addresses = $this->readString($stream);

        $this->imAddresses = $this->readString($stream);

        $this->organization = $this->readString($stream);
    }
}
