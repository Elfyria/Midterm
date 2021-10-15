<?php
/**
 * retrieves a file from a specific address, decodes it into an array
 * @param string $address file address for destination csv file
 * @return array array
 */
function fileFetcher(string $address): array {
    $csv_src = file_get_contents($address);
    $csv_rows = str_getcsv($csv_src, "\n");

    for ($i = 0; $i < count($csv_rows); $i++) {
        $csv_rows[$i] = str_getcsv($csv_rows[$i], "|");
    }
    return $csv_rows;
}

/**
 * Duplicates a random entry, pushes it to the end of the array and saves the array to the source json file.
 * String for file path is static.
 * @param string $quote the quote you want to add
 * @param int $author the ID of the author
 * @param string $address the address of the file to which the quote is appeneded
 */
function makeMan(string $quote, int $author, string $address): void {
    $fileMan = fileFetcher($address);
    array_push($fileMan, [$quote, $author]);
    saveMan($fileMan, $address);
}

/**
 * Hunts for a user with a key equal to an input selector or returns -1. Returns either its index or the user itself.
 * @PARAM $selector string the key of the user you're looking to find
 * @return mixed returns reference to an array or index if found, if not, returns -1
 **/
function huntMan(string $selector): object {
    $obj= new stdClass();
    $csvMan = fileFetcher("./assets/csv/quotes.csv");       //get the array
    $authMan = fileFetcher("./assets/csv/authors.csv");       //get the array
    if ($selector >= count($csvMan) || $selector < 0) {
        die("invalid selector");
    }


    $theLad = $csvMan[$selector];
    
    $obj-> fname=$authMan[$theLad[1]][0];
    $obj-> lname=$authMan[$theLad[1]][1];
    $obj-> quote=$theLad[0];
    $obj-> source=$theLad[2];

    return $obj;
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
 * @param string $mod modified line
 */
function modifyLine(string $address, int $line, string $mod, string $modAuth) {
    $csvarr = fileFetcher($address);                                         //gets the file, $address, as an array.
    if (count($csvarr) < $line) {                                            //if $line is too large,
        echo "This line does not exist, " . $line . ",please try again.";    //outputs error message
        die();                                                               //and kills program
    }

    $csvarr[$line][0] = $mod;                                                //sets the line to its modified version.
    $csvarr[$line][1] = $modAuth;                                            //sets the author to its modified version.
    saveMan($csvarr, $address);                                     //puts array into file at $address.
}


/**
 * Makes a line contain nothing.
 * @param string $address pathway to csv file
 * @param int $line index of line to be deleted
 */
function emptyLine(string $address, int $line) {
    modifyLine($address, $line, "", "");     //modifies line with empty string.
}


/**
 * removes a line at index $line from a file at address $file
 * @param string $address pathway to csv file
 * @param int $line index of target line within csv
 * @return mixed|void
 */
function deleteLine(string $address, int $line) {
    $csvarr = fileFetcher($address);        // gets file at $address, as an array.
    $newarr = [];                           // initializes new array.

    if (count($csvarr) < $line) {                                           // if line doesn't exist, kills program
        echo "This line does not exist," . $line . ",please try again.";
        die();
    }

    for ($i = 0; $line > $i; $i++) {
        $newarr[$i] = $csvarr[$i];                                          // adds $csvarr[$i] to $newarr[$i] before $line.
    }
    for ($i = $line + 1; count($csvarr) > $i; $i++) {
        $newarr[$i - 1] = $csvarr[$i];
    }                                                                       // accounts for $line being removed by adding $csvarr[$i] to $newarr[$i-1].
    saveMan($newarr, $address);                                    // puts array into $id.
    return $csvarr[$line];                                                 // returns line removed to display later.
}

function getCSVSize(string $address) : int {
    $authRay = fileFetcher($address);
    return count($authRay);
}
/**
* checks to make sure username and password are correct.
*@param $uname holds the username to find. 
*@param $pword holds the password to check against the password that is held.
*@return boolean.
*/
function checkUser($uname,$pword){
    $unamearr=fileFetcher("/assets/csv/userandpassword.csv");
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
function newCheck($email,$uname,$pword){
    $blistarr=fileFetcher("/assets/csv/blacklist.csv");
    $unamearr=fileFetcher("/assets/csv/userandpassword.csv");
    $hasnum=false;
    foreach ($blistarr as &$check) {
        if($email==$check){
            echo "Email is blacklisted.";
            return false;
        }
    }
    foreach ($unamearr as &$check) {
        if($uname==$check[0]){
            echo "Username is used.";
            return false;
        }
    }
    foreach ($unamearr as &$check) {
        if($email==$check[2]){
            echo "Email is used.";
            return false;
        }
    }
    if(count($pword)<8){
        echo "Password is too short.";
        return false;
    }
    for($i=0;$i<count($pword);$i++){
        for($f=0;$f<10;$f++){
            if($pword[$i]==$f){
                $hasnum=true;
                break;
            }
         }
        if($hasnum) break;
    }
    if(!$hasnum){
        echo "Password does not contain a number.";
        return false;
    }
    $newUser = '\n'.$uname.'|'.$pword.'|'.$email;
    file_put_contents("/assets/csv/userandpassword.csv", $newUser, FILE_APPEND);
    return true;
}
