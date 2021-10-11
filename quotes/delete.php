<!DOCTYPE html>
<html lang="en">

<head>
    <!-- https://www.bootdey.com/snippets/view/team-user-resume#html -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Great Quotes - Lost to History</title>

    <!-- import bootstrap javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <!-- import bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--import header font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">

    <?php
    //moved here because bootstrap and header will always be imported
    require_once("csv_util.php");                       // gets csv utils.

    if (count($_POST)) {
        //delete the line, tell them you did it, redirect
        $ret = deleteLine("./assets/csv/quotes.csv", $_POST["id"]);    // deletes the line at index $_POST["id"] for the file "assets/csv/quotes/csv".
        //echo new body
        echo "
</head>
<body>
<a href=\"./index.php\" class=\"text-decoration-none\">
    <nav class=\"mt-0 px-1 navbar sticky-top container-fluid d-flex flex-nowrap bg-dark\">
        <!--title-->
        <h2 class=\"text-light ml-2 ml-lg-4 text-wrap w-auto display-4\" style=\"font-family: Prompt\">
            Great Quotes
        </h2>
    </nav>
</a>
<div class=\"container text-center mb-5\">
    <h1><a href=\"./index.php\" class=\"bi bi-house-fill text-secondary mb-5\"></a> Great Quotes
        - What Have You Done?
    </h1>

    <img src=\"https://media.tenor.com/images/0b60c301b5209c27fd98ebbb489c87c9/tenor.gif\" alt=\"a tragedy...\">
    <h2 class=\"text-dark\">Why did you do that?</h2>
    <div>\"" , $ret[0] , "\", was deleted</div>
    <small>You will be redirected shortly. Or just click the home button if you're impatient.</small>
</body>";

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
    ?>

    <!-- import slimmed jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <!-- import some other css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
          integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous"/>

    <!-- impost bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>

<body>
<a href="./index.php" class="text-decoration-none">
    <nav class="mt-0 px-1 navbar sticky-top container-fluid d-flex flex-nowrap bg-dark">
        <!--title-->
        <h2 class="text-light ml-2 ml-lg-4 text-wrap w-auto display-4" style="font-family: Prompt">
            Great Quotes
        </h2>
    </nav>
</a>
<div class="container text-center mb-5">
    <!--<h1><a href="./index.php" class="bi bi-house-fill text-secondary mb-5"></a> ASE 230
        - What Have You Done?
    </h1>

    <img src="https://media.tenor.com/images/0b60c301b5209c27fd98ebbb489c87c9/tenor.gif" alt="a tragedy...">
    <h2 class="text-dark">Why did you do that?</h2>
    <span class="text-muted">You monster.</span>
    <small>You will be redirected shortly. Or just click the home button if you're impatient.</small>-->
    <h1>Are you sure you want to delete this Quote?</h1>
    <div class="mx-1 container row row-cols-1 row-cols-md-2 d-flex align-items-center justify-contents-center">
        <figure class="container-md bg-light p-4 text-center text-wrap col">
            <blockquote class="blockquote">
                <?= $theOne[0] ?>
            </blockquote>
            <figcaption class="blockquote-footer">
                <?= $theOne[2][0], ' ', $theOne[2][1] ?> in <cite title="Source Title">Source Title</cite>
            </figcaption>
        </figure>
        <div class="col w-auto p-3">
            <h5 class="text-muted">Seriously, you can't undo this.</h5>
            <div class="row row-cols-2">
                <div class="row row-cols-1 w-75">
                    <a href="index.php" class="btn btn-outline-dark btn-sm ">Return Home</a>
                    <a href="modify.php?id=<?= $_GET["id"] ?>" class="btn-sm btn btn-outline-dark">Modify Quote</a>
                </div>
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
