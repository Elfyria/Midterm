<!doctype html>
<html lang="en">

<head>
    <?php
    require_once("functions.php");
    require_once("csv_util.php");
    ?>

    <!-- https://www.bootdey.com/snippets/view/single-advisor-profile#html -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--import bootstrap css-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!--import something idk-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

    <!--import bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!--import slimmer jquery-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">

    <!--import bootstrap javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <style>
        #createButton {
            right: 5%;
            bottom: 5%;
            width: 3rem;
            height: 3rem;
            z-index: 5;
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

        @media screen and (max-width:769px) {
            .my-img-class {
                height: auto;
                max-width: 90%;
            }
        }
    </style>
    <title>Directory of Great Quotes</title>

</head>

<body class="mt-0 bg-light">
<a href="./index.php" class="text-decoration-none">
    <nav class="mt-0 px-1 navbar sticky-top container-fluid d-flex flex-nowrap bg-dark">
        <!--title-->
        <h2 class="text-light ml-2 ml-lg-4 text-wrap w-auto display-4" style="font-family: Prompt">
            Great Quotes
        </h2>
        <a href="./authors/index.php" class="btn btn-outline-primary mr-2">Show Authors</a>
    </nav>
</a>
<div class="container">
    <!-- holds cards -->
    <div class="row my-5 ml-3 ml-md-0 w-75">
        <?php
        //card loader
        $quotesArray = fileFetcher("./assets/csv/quotes.csv");
        cardLoader($quotesArray);
        ?>
    </div>
    <!-- button for create -->
    <a href="create.php">
        <button class="btn btn-outline-dark rounded-pill text-center text-nowrap
        position-fixed rounded-circle ratio-1x1 bi-keyboard fs-5 overflow-hidden" id="createButton">
        </button>
    </a>
</div>
</body>


</html>