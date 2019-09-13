<?php
    // ******change to remote host whenever possible******
    $host = "localhost:3306";
    $adminId = "root";
    $adminPassword = "";
    $database = "Contact Manager";


    // try to estable database connection, give error otherwise
    $mysqli = new mysqli($host, $adminId, $adminPassword, $database);
    if ($mysqli != true)
    {
      echo "Error: " .$e->getMessage();
    }
?>
