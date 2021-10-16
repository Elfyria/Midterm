<?php
session_start();
$logged = false;
if (isset($_SESSION)) {                                                     //if session doesn't exist...
    if (count($_SESSION) && $_SESSION["mod"] == true) {                                         //if person has mod set to true, redirect to quotes
        die("<script>window.location = \"./quotes/index.php\";</script>");
    }                                                                       //else, proceed
}
include_once("./assets/templates/head.html");
require_once("./lib/functions.php");
$isAuthors = false;
$isQuotes = false;
?>
<style>
    .my-img-class {
        width: auto;
        max-height: 90%;
    }

    @media screen and (max-width: 769px) {
        .my-img-class {
            height: auto;
            max-width: 90%;
        }
    }
</style>
</head>
<?php
include_once("./assets/templates/navbar.html");
include_once("./assets/templates/notSignedMainButtons.php");

$pnVar = false;
if (count($_GET)) {
    if ($_GET["pn"]) {
        $pnVar = true;
    }
}

?>
<div class="container">
    <!-- holds cards -->
    <div class="row my-5 ml-3 ml-md-0 w-75">
        <?php
        //card loader
        if ($pnVar) {
            $pgLen = cardLoader(intval($_GET["pn"]));
        } else {
            $pgLen = cardLoader(0);
        }
        ?>
    </div>
</div>

<?php
include_once "./assets/templates/paginator.php";
include_once "./assets/templates/footer.html";
?>
</html>