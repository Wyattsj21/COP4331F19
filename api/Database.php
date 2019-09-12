<?php
    // ******change to remote host whenever possible******
    $host = "localhost";
    $adminId = "root";
    $adminPassword = "";
    $database = "user";


    // try to estable database connection, give error otherwise
    $mysqli = new mysqli($host, $adminId, $adminPassword, $database);
    if ($mysqli != true)
    {
      echo "Error: " .$e->getMessage();
    }
?>
