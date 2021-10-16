<?php
/**
 * Main cardloader function, called from within index.php.
 * Loops through array and sends each student entry through the helper function for display.
 * @param int $current current page number
 * @return int total number of pages possible with number of current quotes
 */
function cardLoader(int $current) : int {
    require_once ("./lib/csv_util.php");                        //get CSV_util
    $quotesArray = fileFetcher("./assets/csv/quotes.csv");      //get the quotes
    quoteProcessor($quotesArray);                               //process into objects
    $authRay = fileFetcher("./assets/csv/authors.csv");         //get the authors
    authProcessor($authRay);                                    //process
    $len = ($current * 10) + 10;                                //set end point to $current + 10
    $limit = count($quotesArray);                               //set limit
    for ($i = $current * 10; $i < $len && $i < $limit; $i++) {  //if either are hit, break
        //send quote object, iteration number and corresponding author to helper
        cardLoaderHelper($quotesArray[$i], $i, $authRay[intval($quotesArray[$i]->author)]);
    }
    return ($limit / 10) - 1; //return the total number of pages there should be for use in index
}

/**
 * Echoes a card for a student. Card links to detail.php with $key as the query variable "id".
 * Card includes button for delete.php set up the same way as the detail link
 * @param stdClass $quote The object for the specific quote entry
 * @param int $i the index of the quote itself
 * @param stdClass $author The object for the author of the quote
 */
function cardLoaderHelper(stdClass $quote, int $i, stdClass $author) : void {
    if (strlen($quote->quote) >= 100) {                         //if quote is too long
        $quote->quote = substr($quote->quote, 0, 100)."...";    //truncate it to make the card look better
    }
    ?> <a href="detail.php?id=<?=$i?>" class="text-decoration-none" style="max-width: 540px;">
            <div class="card mb-3 w-100">
                <div class="row g-0">
                    <div class="col-md-4 py-md-2 d-flex justify-content-center align-items-center">
                        <!--placeholder for initials, to be intro\'d later-->
                        <img src="<?=$author->img?>" class="img-fluid ml-md-3 rounded-start img-thumbnail my-img-class" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text text-dark"><?=$quote->quote?></p>
                            <h5 class="card-title text-dark"><?=$author->fName?> <?=$author->lName?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <?php
}

/**
 * Converts an array of csv-formatted strings of quote information into an array of objects with quote information.
 * @param array $quote_rows array of quote info with "|" as the separator
 */
function quoteProcessor(array &$quote_rows) {
    for ($i = 0; $i < count($quote_rows); $i++) {
        $current = explode("|", $quote_rows[$i]);       //explode entry into array
        $obj = new stdClass();                          //initialize object
        $obj->quote = $current[0];                      //put quote to object
        $obj->author = intval($current[1]);             //put author id to object
        $quote_rows[$i] = $obj;                         //replace string with object
    }
}

/**
 * Converts an array of csv-formatted author information strings into an array of objects with author information
 * @param array $author_rows array of author info with "|" as the separator
 */
function authProcessor(array &$author_rows) {
    for ($i = 0; $i < count($author_rows); $i++) {
        $current = explode("|", $author_rows[$i]);      //explode entry into array
        $obj = new stdClass();                          //initialize object
        $obj -> fName=$current[0];                      //put first name to object
        $obj -> lName=$current[1];                      //put last name to object
        $obj -> img=$current[2];                        //put image link to object
        $author_rows[$i] = $obj;                        //replace string with object
    }
}