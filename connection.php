<?php
$host = 'localhost';
$database = 'company';
$user = 'root';
$password = '';
$link = mysqli_connect($host, $user, $password, $database) 
            or die(mysqli_connect_error()); //подключение к бд
?>