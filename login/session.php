<?php
require_once "csv_util.php";
session_start();
if(checkUser($_GET["uname"],$_GET["pword"])){
    $_SESSION["uname"]=$_GET["uname"];
    $_SESSION["mod"]=true;

}
else{
    $_SESSION["uname"]="undefined";
    $_SESSION["mod"]=false;
    die("<script>window.location = \"signin.php?error=true\";</script>");
}
