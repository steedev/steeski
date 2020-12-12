<?php 
    $conn = mysqli_connect('localhost', 'root', '', 'stacje_narciarskie');
    if(!$conn) die("CONNECTION FAILED" . mysqli_connect_error());