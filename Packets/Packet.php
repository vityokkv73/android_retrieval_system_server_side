<?php
class Packet
{
    function readInt($stream)
    {
        $int_array = fread($stream, 4);
        $int = unpack("N", $int_array);
        return $int[1];
    }

    function readByteArray($stream){
        $size_array = fread($stream, 4);
        $size = unpack("N", $size_array);
        return fread($stream, $size[1]);
    }

    function readString($stream)
    {
        return Packet::readByteArray($stream);
    }

    function readLong($stream)
    {
        $size_array = fread($stream, 8);
        $tmp = unpack("N2", $size_array);
        return (4294967296 * $tmp[1] + $tmp[2]);
    }

    function readDouble($stream)
    {
        $size_array = fread($stream, 4);
        $size = unpack("N", $size_array);
        $string_repr = fread($stream, $size[1]);
        return (double) $string_repr;
    }

    function readFloat($stream)
    {
        $size_array = fread($stream, 4);
        $size = unpack("N", $size_array);
        $string_repr = fread($stream, $size[1]);
        return (float) $string_repr;
    }
}
