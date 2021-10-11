<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("csv_util.php");
    require_once("functions.php");
    if (!count($_GET)) {
        die("No entry provided.<br><br><a href='index.php'>Return to main page</a>");
    }

    $theOne = huntMan($_GET["id"], false);
    ?>

    <!-- https://www.bootdey.com/snippets/view/team-user-resume#html -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Great Quote -- <?= $theOne[2][0], ' ', $theOne[2][1]?> </title>

    <!--import jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <!--import bootstrap javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!--import bootstrap css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!--import something???-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
          integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous"/>

    <!--import bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!--import google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">
</head>

<body class="mt-0">
<a href="./index.php" class="text-decoration-none">
    <nav class="mt-0 p-0 navbar sticky-top bg-dark container-fluid d-flex flex-nowrap">
        <!--title-->
        <h2 class="text-light ml-2 ml-lg-4 text-wrap w-auto display-4" style="font-family: Prompt">
            Great Quote
            <div class="h5 mt-0 text-secondary ml-2">from <?= $theOne[2][0], ' ', $theOne[2][1]?></div>
        </h2>
        <!--shape on right of navbar-->
        <div class="btn-group mr-3 d-flex flex-column h-100 flex-md-row">
            <a class="btn btn-dark" href='modify.php?id=<?= $_GET["id"] ?>'>
                <span class="bi bi-pencil-fill"></span><br>
                Modify
            </a>
            <!-- So this setup doesn't look great, but it looks a lot better than the alternative imo -->
            <a class="btn btn-dark" href='delete.php?id=<?= $_GET["id"] ?>'>
                <span class="bi bi-trash-fill"></span><br>
                Delete
            </a>
        </div>
    </nav>
</a>
<div class="container mt-4 d-flex justify-items-center align-items-center">
    <figure class="bg-light p-4 text-center align-self-center">
        <blockquote class="blockquote">
            <?= $theOne[0] ?>
        </blockquote>
        <figcaption class="blockquote-footer">
            <?= $theOne[2][0], ' ', $theOne[2][1] ?> in <cite title="Source Title">Source Title</cite>
        </figcaption>
    </figure>
</div>
</body>

</html>