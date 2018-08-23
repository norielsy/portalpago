<?php
$file = 'dv.log';
$person = "diego_valladares " . date('Y-m-d h:i:s')." \n\t";
file_put_contents($file, $person, FILE_APPEND | LOCK_EX);
?>