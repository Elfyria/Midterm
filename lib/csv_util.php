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
    $quoteMan = fileFetcher("./assets/csv/quotes.csv");       //get the array
    $authorMan = fileFetcher("./assets/csv/authors.csv");       //get the array
    if ($selector >= count($quoteMan) || $selector < 0) {
        die("<script> window.location = \"detail.php?id=0\"");
    }

    $theLad = $quoteMan[$selector];
    $theLad = explode("|", $theLad);
    $author = $authorMan[intval($theLad[1])];
    $author = explode("|", $author);

    $obj-> fName=$author[0];
    $obj-> lName=$author[1];
    $obj-> quote=$theLad[0];
    $obj-> aID=intval($theLad[1]);

    return $obj;
}

function checkUser($uname,$pword){
    $unamearr=fileFetcher("userandpassword.csv");
    foreach ($unamearr as &$check){
        if($check[0]==$uname){
            if($check[1]==$pword) return true;                  //if password matches return true.
            else 
                {echo "Incorrect password.";                   //if password does not match, echo Incorrect password.
                return false;}                                 // returns false.
        }                                                   //checks username.
    }                                                   //iterates through $unamearr.
    echo "No such username.";                           // if username doesn't exist, echo No such username.
    return false;                                       //return false.
}
