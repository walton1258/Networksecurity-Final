<?php
session_start();
$dbHost = 'localhost';
$dbName = 'network_security1db';
$dbUsername = 'root';
$dbPassword = '';
$dbc= mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
?>