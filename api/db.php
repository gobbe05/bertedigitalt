<?php 

$dbhost = "bertemuseum-digitalt.se.mysql";
$dbuser = "bertemuseum_digitalt_sedbobjekt";
$dbpass = "Karatekr05";
$db = "bertemuseum_digitalt_sedbobjekt";
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $db) or die ("Connect failed %\n". $conn -> error);
