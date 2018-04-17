<?php
session_start();
include "connectDB.php";

$name=$_SESSION["firstName"]." ".$_SESSION["lastName"];

echo $name;