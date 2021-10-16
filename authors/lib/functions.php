<?php
/**
 * Main cardloader function, called from within index.php.
 * Loops through array and sends each student entry through the helper function for display.
 * @PARAM &$authorsArray array reference to an associative array whose data will be displayed.
 **/
function cardLoader(int $current): int {
    require_once("./lib/csv_util.php");
    $authRay = fileFetcher("../assets/csv/authors.csv");         //get the authors
    authProcessor($authRay);                                    //process
    $len = ($current * 10) + 10;                                //set end point to $current + 10
    $limit = count($authRay);                               //set limit
    for ($i = $current * 10; $i < $len && $i < $limit; $i++) {  //if either are hit, break
        cardLoaderHelper($authRay[$i], $i);        //send current entry to helper
    }

    return $limit / 10 - 1;
}

/**
 * Echoes a card for a student. Card links to detail.php with $key as the query variable "id".
 * Card includes button for delete.php set up the same way as the detail link
 * @param stdClass $author The array for the specific quote entry
 * @param int $i the index of the quote itself
 */
function cardLoaderHelper(stdClass $author, int $i): void {
    ?><a href="detail.php?id=<?= $i ?>" class="m-md-2 text-decoration-none" style="width:45%;">
    <div class="card d-flex">
        <img src="<?= $author->img ?>" class="img-fluid my-img-class card-img-top" alt="...">
        <div class="card-body">
            <h5 class="fs-4 card-title text-dark"><?= $author->fName ?> <?= $author->lName ?></h5>
        </div>
    </div>
    </a>
    <?php
}

/**
 * Converts an array of csv-formatted author information strings into an array of objects with author information
 * @param array $author_rows array of author info with "|" as the separator
 */
function authProcessor(array &$author_rows) {
    for ($i = 0; $i < count($author_rows); $i++) {
        $current = explode("|", $author_rows[$i]);      //explode entry into array
        $obj = new stdClass();                          //initialize object
        $obj->fName = $current[0];                      //put first name to object
        $obj->lName = $current[1];                      //put last name to object
        $obj->img = $current[2];                        //put image link to object
        $author_rows[$i] = $obj;                        //replace string with object
    }
}

/**
 * Main cardloader function, called from within index.php.
 * Loops through array and sends each student entry through the helper function for display.
 * @PARAM &$quotesArray array reference to an associative array whose data will be displayed.
 **/
function quoteLoader(array &$quotesArray): void {
    $len = count($quotesArray);                                    //determine length
    for ($i = 0; $i < $len; $i++) {
        quoteLoaderHelper($quotesArray[$i], $i);                    //send current entry to helper
    }
}

/**
 * Echoes a card for a student. Card links to detail.php with $key as the query variable "id".
 * Card includes button for delete.php set up the same way as the detail link
 * @param array $quote The array for the specific quote entry
 * @param int $i the index of the quote itself
 */
function quoteLoaderHelper(array $quote, int $i): void {
    ?>
    <figure class="bg-light p-4 text-center mx-4">
        <blockquote class="blockquote">
            <?= $quote[0] ?>
        </blockquote>
    </figure>
    <br><br>
    <?php
}

function checkUser($uname) {
    require_once ("csv_util.php");
    $unamearr = fileFetcher("../sign/assets/userandpassword.csv");
    foreach ($unamearr as &$check) {
        $check = explode("|", $check);
        if ($check[0] == $uname) {
            return true;
        }                                                   //checks username.
    }                                                   //iterates through $unamearr.
    echo "No such username.";                           // if username doesn't exist, echo No such username.
    return false;                                       //return false.
}
