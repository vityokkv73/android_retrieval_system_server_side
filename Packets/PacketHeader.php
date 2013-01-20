<?php
class PacketHeader
{
    var $packetLength;
    var $dataType;
    var $imei;
    const HEADER_SIZE = 12;

    function PacketHeader($stream)
    {
        $data = fread($stream, PacketHeader::HEADER_SIZE);
        $header = unpack("N3", $data);
        $this->packetLength = $header[1];
        $this->dataType = $header[2];
        $imeiLength = $header[3];
        $this->imei = fread($stream, $imeiLength);
    }
}
