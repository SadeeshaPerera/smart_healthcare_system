<?php

    $database= new mysqli("localhost","root","","edoc",3377);
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>