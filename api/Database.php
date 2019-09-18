<?php
    // ******change to remote host whenever possible******
    $host = "198.71.231.46:3306";
    $adminId = "DefaultUser";
    $adminPassword = "POOSD4331";
    $database = "Contact Manager";


    // try to estable database connection, give error otherwise
    $mysqli = new mysqli($host, $adminId, $adminPassword, $database);
    if ($mysqli != true)
    {
      echo "Error: " .$e->getMessage();
    }
?>
