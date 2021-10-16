<?php
session_start();
include_once "../assets/templates/head.html";
require_once("lib/functions.php");
$isAuthors = true;
$isQuotes = false;$logged = false;
if (isset($_SESSION)) {
    if (count($_SESSION)) {                                         //if person has mod set to true, enable logged capabilities
        if ($_SESSION["mod"] && $_SESSION["uName"]) {                                         //if person has mod set to true, enable logged capabilities
            if ($_SESSION["mod"] == true && checkUser($_SESSION["uName"])) {                                         //if person has mod set to true, enable logged capabilities
                $logged = true;
            }
        }
    }
}
?>

<style>
    #createButton {
        right: 5%;
        bottom: 5%;
        width: 3rem;
        height: 3rem;
        z-index: 500;
        transition: all 0.25s ease-in-out;
        -webkit-transition: all 0.25s ease-in-out;
        -moz-transition: all 0.25s ease-in-out;
    }

    #createButton:hover {
        width: 7rem;
        transition: all 0.25s ease-in-out;
        -webkit-transition: all 0.25s ease-in-out;
        -moz-transition: all 0.25s ease-in-out;
    }

    #createButton:hover::after {
        content: "create";
    }

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
<title>Directory of Great Quotes</title>
</head>
<?php
include_once("../assets/templates/navbar.html");
include_once("../assets/templates/notSignedMainButtons.php");
$pnVar = false;
if (count($_GET)) {
    if ($_GET["pn"]) {
        $pnVar = true;
    }
}
?>
</nav>
</a>
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
    <!-- button for create -->
    <?php
    if ($logged) {
        ?>
        <a href="create.php">
            <button class="btn btn-outline-secondary rounded-pill text-center text-nowrap
            position-fixed rounded-circle ratio-1x1 bi-keyboard fs-5 overflow-hidden" id="createButton">
            </button>
        </a>
        <?php
    }
    ?>
</div>
<!-- button for create -->
<?php
if ($logged) {
    ?>
    <a href="create.php">
        <button class="btn btn-outline-dark rounded-pill text-center text-nowrap
        position-fixed rounded-circle ratio-1x1 bi-keyboard fs-5 overflow-hidden" id="createButton">
        </button>
    </a>
    <?php
}
?>
<?php
include_once "../assets/templates/paginator.php";
include_once "../assets/templates/footer.html";
?>
</html>