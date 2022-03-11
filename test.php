<?php
$strong="engr_temilewa@yahoo.com";
$string=openssl_random_pseudo_bytes("16",$strong);
$hex=bin2hex($string);

echo $string;
echo $hex;













?>