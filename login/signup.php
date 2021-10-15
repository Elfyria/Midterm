<?php
if(newCheck($_GET["email"], $_GET["uname"],$_GET["pword"])){
  session_start();
  $_SESSION["uname"]=$_GET["uname"];
    $_SESSION["pword"]=$_GET["pword"];
    $_SESSION["mod"]=true;
}
