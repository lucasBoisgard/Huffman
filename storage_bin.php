<?php
    system("clear");


    /*
     *  convert $string_bin to int
     */
    $bin = intval($string_bin, 2);
    var_dump(decbin($bin));

    /*
     *  write $bin in 'file_name' and convert type to binary
     */
    file_put_contents("yo.php", pack("s*", $bin));

    system("cat yo.php && ls -la yo.php");

    /*
     *  get file(file_name), convert this content type binary to int and convert this to string
     */
    var_dump (decbin(unpack("c", file_get_contents("yo.php"))[1]));
