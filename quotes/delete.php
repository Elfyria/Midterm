<?php
session_start();
$logged = false;
if (isset($_SESSION)) {                                                     //if session doesn't exist...
    if ($_SESSION["mod"] == true) {                                         //if person has mod set to true, redirect to quotes
        $logged = true;
    } else {
        header("Location: ../sign/in.php?error=true");
    }
} else {
    header("Location: ../sign/in.php?error=true");
}

include_once("../assets/templates/head.html");
require_once("./lib/csv_util.php");
require_once("./lib/functions.php");
$isAuthors = true;
$isQuotes = false;
if (count($_POST)) {
    //delete the line, tell them you did it, redirect
    $ret = deleteLine("../assets/csv/quotes.csv", $_POST["id"]);    // deletes the line at index $_POST["id"] for the file "assets/csv/quotes/csv".
    //echo new body
    echo "</head>"; ?>
    <body>
    <a href="./index.php" class=\"text-decoration-none\">
        <nav class="mt-0 px-1 navbar sticky-top container-fluid d-flex flex-nowrap bg-dark">
            <!--title-->
            <h2 class="text-light ml-2 ml-lg-4 text-wrap w-auto display-4" style="font-family: Prompt">
                Great Quotes
            </h2>
        </nav>
    </a>
    <div class="container text-center mb-5">
        <h1><a href="./index.php" class="bi bi-house-fill text-secondary mb-5"></a> Great Quotes
            - What Have You Done?
        </h1>

        <img src="https://media.tenor.com/images/0b60c301b5209c27fd98ebbb489c87c9/tenor.gif" alt=\"a tragedy...\">
        <h2 class="text-dark">Why did you do that?</h2>
        <div>"<?= $ret[0] ?>", was deleted</div>
        <small>You will be redirected shortly. Or just click the home button if you're impatient.</small>
    </body>
    <?php
    die("<script>
            setTimeout(function () {
                window.location = \"index.php\";
            } , 10000);
            </script>");                            //kill program with redirect script
} elseif (count($_GET)) {
    $theOne = huntMan($_GET["id"]);
} else {
    //no id, no good formatting, sorry kid
    die("No entry provided.<br><br><a href='index.php'>Return to main page</a>");
}
echo "</head>";
include_once "../assets/templates/navbar.html";
?>
</nav>
</a>
<div class="container text-center mb-5">
    <h1>Are you sure you want to delete this Quote?</h1>
    <div class="mx-1 container row row-cols-1 row-cols-md-2 d-flex align-items-center justify-contents-center">
        <figure class="container-md bg-light p-4 text-center text-wrap col">
            <blockquote class="blockquote">
                <?= $theOne->quote ?>
            </blockquote>
            <figcaption class="blockquote-footer">
                <?= $theOne->fName, ' ', $theOne->lName ?> in <cite title="Source Title">Source Title</cite>
            </figcaption>
        </figure>
        <div class="col w-auto p-3">
            <h5 class="text-muted">Seriously, you can't undo this.</h5>
            <div class="row row-cols-1 w-auto m-1">
                <a href="index.php" class="btn btn-outline-dark btn-sm">Return Home</a>
                <a href="modify.php?id=<?= $_GET["id"] ?>" class="w-25 btn-sm btn btn-outline-dark">Modify Quote</a>
                <form id="formMan" method="post" action="delete.php" class="p-0 w-25">
                    <input hidden type="text" name="id" value="<?= $_GET["id"] ?>">
                    <button type="submit" class="m-0 h-100 w-100 btn btn-sm btn-outline-danger bi bi-trash"></button>
                </form>
            </div>
        </div>
    </div>

</div>
</body>

</html>
