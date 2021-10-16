<?php
/**
 * retrieves a file from a specific address, decodes it into an array
 * @param string $address file address for destination csv file
 * @return array array
 */
function fileFetcher(string $address): array {
    $csv_src = file_get_contents($address);
    return str_getcsv($csv_src, "\n");
}

/**
 * Hunts for a user with a key equal to an input selector or returns -1. Returns either its index or the user itself.
 * @PARAM $selector string the key of the user you're looking to find
 * @return mixed returns reference to an array or index if found, if not, returns -1
 **/
function huntMan(string $selector): stdClass {
    $obj = new stdClass();
    $quoteMan = fileFetcher("../assets/csv/quotes.csv");       //get the array
    $authMan = fileFetcher("../assets/csv/authors.csv");       //get the array
    if ($selector >= count($authMan) || $selector < 0) {
        header("Location: ../index.php");
        die("invalid selector");
    }

    $theLad = $authMan[$selector];
    $theLad = explode("|", $theLad);
    $quoteLad = [];

    for ($i = 0; $i < count($quoteMan); $i++) {
        $quoteMan[$i] = explode("|", $quoteMan[$i]);
        if (intval($quoteMan[$i][1]) == $selector) {
            array_push($quoteLad, $quoteMan[$i]);
        }
    }

    $obj->fName = $theLad[0];
    $obj->lName = $theLad[1];
    $obj->image = $theLad[2];
    $obj->quotes = $quoteLad;

    return $obj;
}

/**
 * Duplicates a random entry, pushes it to the end of the array and saves the array to the source json file.
 * String for file path is static.
 * @param string $fName the first name of the author
 * @param string $lName the last name of the author
 * @param string $imageLink link to an imge of the author
 * @param string $address the address of the file to which the author's info is appeneded
 * @return void
 */
function makeMan(string $fName, string $lName, string $imageLink, string $address): void {
    $fileMan = fileFetcher($address);
    $len = count($fileMan);
    for ($i = 0; $i < $len; $i++) {
        $fileMan[$i] = explode("|", $fileMan[$i]);
    }
    array_push($fileMan, [$fName, $lName, $imageLink]);
    saveMan($fileMan, $address);
}

/**
 * Converts a PHP array into a csv-formatted string, saves the string into a csv file line by line.
 * @param $csvman array nested array of values
 * @param string $address file path to a file which must already exist.
 * @return void
 */
function saveMan(array &$csvman, string $address): void {
    if (file_exists($address)) {                                            //ensure file exists
        $file = fopen($address, 'w');                                 //open file
        $i = 0;                                                             //initialize incrementer
        for (; $i < count($csvman); $i++) {                                 //loop through
            fputcsv($file, $csvman[$i], '|');                       //rewrite each line
        }
        fclose($file);                                                      //close file
    } else {
        echo "File \"" . $address . "\" not found.";                         //if file doesn't exist...
        die();                                                                //die
    }
}


/**
 * puts a modified line at an index within a csv file
 * @param string $address pathway to csv file
 * @param int $line index of original line
 * @param string $fName
 * @param string $lName
 * @param string $imgLink
 */
function modifyLine(string $address, int $line, string $fName, string $lName, string $imgLink) {
    $csvarr = fileFetcher($address);                                         //gets the file, $address, as an array.
    for ($i = 0; $i < count($csvarr); $i++) {
        $csvarr[$i] = explode("|", $csvarr[$i]);
    }
    if (count($csvarr) < $line) {                                            //if $line is too large,
        echo "This line does not exist, " . $line . ",please try again.";    //outputs error message
        die();                                                               //and kills program
    }

    $csvarr[$line][0] = $fName;                                                //sets the line to its modified version.
    $csvarr[$line][1] = $lName;                                                //sets the line to its modified version.
    $csvarr[$line][2] = $imgLink;                                            //sets the author to its modified version.
    saveMan($csvarr, $address);                                     //puts array into file at $address.
}

/**
 * Makes a line contain nothing.
 * @param string $address pathway to csv file
 * @param int $line index of line to be deleted
 */
function emptyLine(string $address, int $line) {
    modifyLine($address, $line, "", "", "");     //modifies line with empty string.
}


/**
 * removes a line at index $line from a file at address $file
 * @param string $address pathway to csv file
 * @param int $line index of target line within csv
 * @return mixed|void
 */
function deleteLine(string $address, int $line) {
    $csvarr = fileFetcher($address);        // gets file at $address, as an array.
    for ($i = 0; $i < count($csvarr); $i++) {
        $csvarr[$i] = explode("|", $csvarr[$i]);
    }
    if (count($csvarr) < $line || $line < 0) {                                           // if line doesn't exist, kills program
        echo "This line does not exist," . $line . ",please try again.";
        die("<a href='../index.php'>Return Home</a>");
    }

    $csvarr[$line][0] = "Anonymous";
    $csvarr[$line][1] = "Author";
    $csvarr[$line][2] = "https://pbs.twimg.com/profile_images/1268660533127008256/UNoc474t_400x400.jpg";
    saveMan($csvarr, $address);                                    // puts array into $id.
    return $csvarr[$line];                                                 // returns line removed to display later.
}

function getCSVSize(string $address): int {
    $authRay = fileFetcher($address);
    return count($authRay);
}