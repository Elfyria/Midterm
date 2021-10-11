<?php
require_once("csv_util.php");
if (count($_POST)) {
    makeMan($_POST["quote"], $_POST["author"], "./assets/csv/quotes.csv");
    print_r($_POST);
    die();
} else {
    require_once("functions.php");
    $authLength = getCSVSize("./assets/csv/authors.csv");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- https://www.bootdey.com/snippets/view/team-user-resume#html -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Great Quotes - New Quote</title>

    <!--jquery slim import-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <!--bootstrap javascript import-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>

    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--some kinda css idk-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css"
          integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous"/>

    <!--bootstrap icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt&display=swap" rel="stylesheet">

    <script>
        $("#formMan").ready(function () {
            $("#formMan").submit(function (event) {
                event.preventDefault();
                let aNum = parseInt($("#authorIn")[0].value);                    //initialize author input val
                let validated;                                                      //declare continue var

                if (aNum <= <?= $authLength ?>) {                              //if valid
                    $("#authorIn").addClass("valid");                                 //set field as valid
                    $("#feedback")[0].innerHTML = "all good";                       //feedback
                    validated = true;
                } else {                                                        //not valid
                    $("#authorIn").addClass("invalid");                               //set field as invalid
                    $("#feedback")[0].innerHTML = "Please enter a valid author";    //feedback
                    validated = false;
                }

                if (validated) {
                    /*
                    I'm aware of how easy a SQL injection would be here, but this is the only method I could find
                    that enabled pre-submission processing on the client side without AJAX methods. Any advice on how
                    to improve this would be appreciated.
                    */
                    let baseurl = "create.php";         //initialize base url
                    let quote = $("#quoteIn").val();    //initialize quote text (this is the huge vulnerability)

                    //create a hidden form with all information from main form
                    let form = $('<form hidden action="' + baseurl + '" method ="post">' +
                        '<input type="text" name="author" value="' + aNum + '" />'+
                        '<input type="text" name="quote" value="' + quote + '" />'+
                        '</form>');

                    $("body").append(form);         //append to body to enable functionality

                    form.submit();                  //submit the hidden form, forcing the redirect with post
                }                                   //no else
            }); //end of .submit
        }); //end of .ready
    </script>

</head>

<body class="mt-0">
<a href="./index.php" class="text-decoration-none">
    <nav class="mt-0 p-0 navbar sticky-top bg-dark container-fluid d-flex flex-nowrap">
        <!--title-->
        <h2 class="text-light mx-2 mx-lg-4 text-wrap w-auto display-4" style="font-family: Prompt">
            Great Quote
        </h2>
        <!--shape on right of navbar-->
        <div class="btn-group mr-3 d-flex flex-column h-100 flex-md-row">
        </div>
    </nav>
</a>
<div class="container text-center">
    <form class="form mt-4 needs-validation" id="formMan" method="post" action="create.php">
        <div class="form-floating my-2">
            <input class="form-control invalid" type="text" name="authorIn" id="authorIn" placeholder="Author">
            <label for="authorIn">Author</label>
        </div>
        <span id="feedback"></span>
        <div class="form-floating my-2">
            <textarea class="form-control" name="quoteIn" id="quoteIn" placeholder="quote" style="height:
            7rem;"></textarea>
            <label for="quoteIn">Quote</label>
        </div>
        <button type="submit" class="btn btn-outline-dark w-auto">Submit</button>
    </form>
</div>
</body>
</html>