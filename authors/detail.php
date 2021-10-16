<?php
session_start();
$logged = false;
if (isset($_SESSION)) {                                                     //if session doesn't exist...
    if ((count($_SESSION) && $_SESSION["mod"] == true)) {                                         //if person has mod set to true, redirect to quotes
        $logged = true;
    }                                                                        //else, proceed
}

if (!count($_GET)) {
    die("<script>window.location = \"../index.php\";</script>");
}

include_once("../assets/templates/head.html");
require_once("./lib/functions.php");
require_once("./lib/csv_util.php");
$isAuthors = true;
$isQuotes = false;
$theOne = huntMan($_GET["id"]);
?>
</head>
<?php
include_once("../assets/templates/navbar.html");
?>
<script>
    $(document).ready(function () {
        $("#navTitle").ready(function () {
            let stringThing = "<div class='h5 mt-0 mb-3 text-secondary ml-2'>from <?= $theOne->fName, ' ', $theOne->lName?></div>"
            $("#navTitle").append(stringThing);
        });
    });
</script>
<?php
include_once ("../assets/templates/".(($logged)? "modDelButtons.php" : "notSignedMainButtons.php"));
?>
</nav>
</a>
<div class="container mt-4 row">
    <?php quoteLoader($theOne->quotes); ?>
</div>
<?php
include_once "../assets/templates/footer.html";
?>

</html>