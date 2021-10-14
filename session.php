<?php
require_once "csv_util.php";
if(checkUser($_GET["uname"],$_GET["pword"])) session_start();