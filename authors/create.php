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
$authLength = getCSVSize("../assets/csv/authors.csv");

if (count($_POST)) {
    makeMan($_POST["fName"], $_POST["lName"], $_POST["img"], "../assets/csv/authors.csv");
    echo "</head>";
    include_once("../assets/templates/navbar.html");
    ?>
    </nav>
    </a>
    <div class='text-center'>
        <h1 class="mt-3">New Author:</h1>
        <p>"<?= $_POST["fName"], ' ', $_POST["lName"] ?>"<br></p>
        <p>Author ID set to <?= $authLength ?> <br><br></p>
        <a class="btn btn-dark" href="detail.php?id=<?= $authLength  ?>">Return to Detail</a>
    </div>
    <?php die(); //die
}
?>

<script>
    $("#formMan").ready(function () {
        $("#imgIn").change(function() {
            console.log(this);
            $("#imgMan").attr("src", $("#imgIn").val());
        });
    }); //end of .ready
</script>

</head>
<?php
include_once "../assets/templates/navbar.html";
?>
</nav>
</a>
<div class="container text-center">
    <form class="form mt-4 needs-validation" id="formMan" method="post" action="create.php">
        <div class="d-flex">
            <div class="w-50 mx-0 float-left">
                <img id="imgMan" src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Placeholder_view_vector.svg" class="w-75 h-auto img-thumbnail m-2">
                <input class="form-control w-100" type="text" name="img" id="imgIn" placeholder="Link to Image" required>
            </div>
            <div class="my-2 w-50 mx-0 float-right">
                <input class="form-control w-50 my-2" type="text" name="fName" id="fNameIn" placeholder="First Name" required/>
                <input class="form-control w-50 my-2" type="text" name="lName" id="lNameIn" placeholder="Last Name" required/>
            </div>
        </div>
        <button type="submit" class="mt-5 btn btn-outline-dark">Submit</button>
    </form>
</div>
</body>
</html>