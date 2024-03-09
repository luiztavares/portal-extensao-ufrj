<?php
$myfile = fopen("env", "r") or die("Unable to open file!");
echo fread($myfile,filesize("env"));
fclose($myfile);
?>