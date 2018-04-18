<?php
session_start();

if(isset($_SESSION["userId"])&&!empty($_SESSION["userId"])) {
    include "connectDB.php";

    $name = $_SESSION["firstName"] . " " . $_SESSION["lastName"];

    echo $name;
}