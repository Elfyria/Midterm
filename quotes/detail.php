<?php
session_start();
$logged = false;
if (isset($_SESSION)) {                                                     //if session doesn't exist...
    if ((count($_SESSION) && $_SESSION["mod"] == true)) {                                         //if person has mod set to true, redirect to quotes
        $logged = true;
    }                                                                       //else, proceed
}

include_once("../assets/templates/head.html");
require_once("./lib/functions.php");
require_once("./lib/csv_util.php");

if (!count($_GET)) {
    die("<script>window.location = \"../index.php\";</script>");
}

$theOne = huntMan($_GET["id"]);
include_once ("../assets/templates/navbar.html");
?>
</head>
<?php
$isAuthors = false;
$isQuotes = false;
include_once ("../assets/templates/".(($logged)? "modDelButtons.php" : "notSignedMainButtons.php"));
?>
    </nav>
</a>
<div class="container mt-4 d-flex justify-items-center align-items-center">
    <figure class="bg-light p-4 text-center align-self-center">
        <blockquote class="blockquote">
            <?= $theOne->quote ?>
        </blockquote>
        <figcaption class="blockquote-footer">
            <?= $theOne->fName, ' ', $theOne->lName ?> in <cite title="Source Title">Source Title</cite>
        </figcaption>
    </figure>
</div>
</body>

</html>