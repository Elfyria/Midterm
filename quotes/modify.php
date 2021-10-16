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
require_once("./lib/functions.php");
require_once("./lib/csv_util.php");
$isAuthors = false;
$isQuotes = true;
if (count($_POST)) {
    $id = "../assets/csv/quotes.csv";       //destination address
    $line = $_POST["line"];                 //index of line in file
    $mod = $_POST["mod"];                   //modified line
    $modAuth = $_POST["author"];            //modified author

    modifyLine($id, $line, $mod, $modAuth);

    echo "</head>";
    include_once("../assets/templates/navbar.html");
    ?>
    </nav>
    </a>
    <div class='text-center'>
        <h1 class="mt-3">New Quote:</h1>
        <p>"<?= $mod ?>"<br></p>
        <p>Author ID set to <?= $modAuth ?> <br><br></p>
        <a class="btn btn-dark" href="detail.php?id=<?= $line ?>">Return to Detail</a>
    </div>
    <?php die(); //die
} elseif (count($_GET)) {
    $id = $_GET["id"];
    $entry = huntMan($id);
    $authLength = getCSVSize("../assets/csv/authors.csv") - 1;
} else {
    die("No entry provided.<br><br><a href='index.php'>Return to main page</a>");
}
?>
<script>
    $("#formMan").ready(function () {
        $("#formMan").submit(function (event) {
            event.preventDefault();
            let aNum = parseInt($("#authorIn")[0].value);                    //initialize author input val
            let validated;                                                      //declare continue var

            if (aNum <= <?= $authLength ?>) {                              //if valid
                $("#authorIn").addClass("valid");                               //set field as valid
                $("#feedback")[0].innerHTML = "all good";                       //feedback
                validated = true;
            } else {                                                        //not valid
                $("#authorIn").addClass("invalid");                             //set field as invalid
                $("#feedback")[0].innerHTML = "Please enter a valid author";    //feedback
                validated = false;
            }

            if (validated) {
                /*
                I'm aware of how easy a SQL injection would be here, but this is the only method I could find
                that enabled pre-submission processing on the client side without AJAX methods. Any advice on how
                to improve this would be appreciated.
                */
                let baseurl = "modify.php";         //initialize base url
                let quote = $("#quoteIn").val();    //initialize quote text (this is the huge vulnerability)

                //create a hidden form with all information from main form
                let form = $('<form hidden action="' + baseurl + '" method ="post">' +
                    '<input type="text" name="author" value="' + aNum + '" />' +
                    '<input type="text" name="mod" value="' + quote + '" />' +
                    '<input type="text" name="line" value="' + <?= $_GET["id"] ?> + '" />' +
                    '</form>');

                $("body").append(form);         //append to body to enable functionality

                form.submit();                  //submit the hidden form, forcing the redirect with post
            }                                   //no else
        }); //end of .submit
    }); //end of .ready
</script>
</head>
<?php include_once("../assets/templates/navbar.html"); ?>
</nav>
</a>
<div class="container text-center">
    <form class="form mt-4 needs-validation w-75" id="formMan" method="post" action="modify.php">
        <div class="my-2">
            <label for="authorIn">Author</label>
            <input class="form-control" type="text" name="authorIn" id="authorIn" placeholder="Author"
                   value="<?= $entry->aID ?>">
        </div>
        <span id="feedback"></span>
        <div class="my-2">
            <label for="quoteIn">Quote</label>
            <textarea class="form-control" name="quoteIn" id="quoteIn" placeholder="quote" style="height:
            7rem;"><?= $entry->quote ?></textarea>
        </div>
        <button type="submit" class="btn btn-outline-dark w-auto">Submit</button>
    </form>
</div>
</body>

</html>