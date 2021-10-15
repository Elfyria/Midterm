<?php
require_once "csv_util.php";
session_start();
if(checkUser($_GET["uname"],$_GET["pword"])){ 
    $_SESSION["uname"]=$_GET["uname"];
    $_SESSION["pword"]=$_GET["pword"];
    $_SESSION["mod"]=true;}
else{
    $_SESSION["uname"]="undefined";
    $_SESSION["pword"]="";
    $_SESSION["mod"]=false;}
