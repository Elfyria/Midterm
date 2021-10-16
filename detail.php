<?php
session_start();
$logged = false;
if (isset($_SESSION)) {                                                     //if session doesn't exist...
    if (count($_SESSION) && $_SESSION["mod"] == true) {                                         //if person has mod set to true, redirect to quotes
        die("<script>window.location = \"/quotes/index.php\";</script>");
    }                                                                       //else, proceed
}

if (!count($_GET)) {
    die("<script>window.location = \"../index.php\";</script>");
}

include_once("./assets/templates/head.html");
require_once("./lib/functions.php");
require_once("./lib/csv_util.php");
$isAuthors = false;
$isQuotes = false;
$theOne = huntMan($_GET["id"]);

?>
</head>
<?php
include_once("./assets/templates/navbar.html");
include_once("./assets/templates/notSignedMainButtons.php");
?>
<div class="container mt-4 d-flex justify-items-center align-items-center">
    <figure class="bg-light p-4 text-center align-self-center">
        <blockquote class="blockquote">
            <?= $theOne->quote ?>
        </blockquote>
        <figcaption class="blockquote-footer">
            <a class="text-decoration-none text-muted" href="./authors/detail.php?id=<?= $theOne -> aID ?>">
                <?= $theOne->fName, ' ', $theOne->lName ?>
            </a>
        </figcaption>
    </figure>
</div>
</body>

</html>