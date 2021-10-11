<?php
/**
 * Main cardloader function, called from within index.php.
 * Loops through array and sends each student entry through the helper function for display.
 * @PARAM &$quotesArray array reference to an associative array whose data will be displayed.
 **/
function cardLoader(array &$quotesArray) : void {
    $len = count($quotesArray);                                    //determine length
    for ($i = 0; $i < $len; $i++) {
        cardLoaderHelper($quotesArray[$i], $i);        //send current entry to helper
    }
}

/**
 * Echoes a card for a student. Card links to detail.php with $key as the query variable "id".
 * Card includes button for delete.php set up the same way as the detail link
 * @param array $quote  The array for the specific quote entry
 * @param int $i        the index of the quote itself
 */
function cardLoaderHelper(array $quote, int $i) : void {
    $author = authHunter($quote[1]);
    if (strlen($quote[0]) >= 100) {                                 //if quote is too long
        $quote[0] = substr($quote[0], 0, 100)."...";    //truncate it to make the card look better
    }
    echo '<a href="detail.php?id=', $i ,'" class=" w-100 text-decoration-none">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 py-md-2 d-flex justify-content-center align-items-center">
                        <!--placeholder for initials, to be intro\'d later-->
                        <img src="', $author[2] ,'"class="img-fluid ml-md-3 rounded-start img-thumbnail my-img-class" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <p class="card-text text-dark">',$quote[0], '</p>
                            <h5 class="card-title text-dark">', $author[0] ,' ',$author[1] , '</h5>
                        </div>
                    </div>
                </div>
            </div>
    </a>';
}

/**
 * finds and returns the entry on an author
 * @param int $aID ID of author
 * @return array array of author information
 */
function authHunter(int $aID): array {
    require_once("csv_util.php");
    $authRay = fileFetcher("./assets/csv/authors.csv");     //get array of authors
    return $authRay[$aID];                                         //return appropriate entry
}