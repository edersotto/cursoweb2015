<?php


$mysqli = new mysqli("127.0.0.1", "root", "",  "curso");

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') '
            . $mysqli->connect_error);
}


$mysqli->set_charset("utf8");

?>