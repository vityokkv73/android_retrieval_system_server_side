<?php
include 'Packet.php';
class Image extends Packet
{
    var $display_name;
    var $file_path;
    var $store_id;
    var $time;
    var $image_array;
    var $local_file_path;

    function Image($stream)
    {
        $this->display_name = $this->readString($stream);

        $this->file_path = $this->readString($stream);

        $this->store_id = $this->readInt($stream);

        $this->time = $this->readLong($stream);

        $this->image_array = $this->readByteArray($stream);
    }

    function saveImage($id)
    {
        $path_to_thumbnails = "./user_images/$id";
        mkdir($path_to_thumbnails, 0700, true);
        $extension = preg_replace("/.*?\./", '', $this->display_name);
        $local_file_path =  $path_to_thumbnails ."/" . mt_rand(0, 10000000) . "($this->store_id)" . $extension;
        $fp=fopen($local_file_path, 'wb');
        fwrite($fp, $this->image_array);
        fclose($fp);
    }
}
