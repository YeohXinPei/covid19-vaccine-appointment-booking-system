<?php

/* attempt to connect to MySQL database */
$conn = mysqli_connect("localhost", "root", "", "users");

/* check connection */
if (!$conn) {
    echo "Connection Failed";
}