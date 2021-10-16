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
 * checks to make sure username and password are correct.
 * @param $uname string holds the username to find.
 * @param $pword string holds the password to check against the password that is held.
 * @return boolean.
 */
function checkUser($uname, $pword) {
    $unamearr = fileFetcher("./assets/userandpassword.csv");
    foreach ($unamearr as &$check) {
        if ($check[0] == $uname) {
            if ($check[1] == $pword) return true;                  //if password matches return true.
            else {
                echo "Incorrect password.";                   //if password does not match, echo Incorrect password.
                return false;                                 //and return false.
            }
        }                                                   //checks username.
    }                                                   //iterates through $unamearr.
    echo "No such username.";                           // if username doesn't exist, echo No such username.
    return false;                                       //return false.
}

function newCheck($email, $uname, $pword) {
    $blistarr = fileFetcher("./assets/blacklist.csv");
    $unamearr = fileFetcher("./assets/userandpassword.csv");
    $hasnum = false;
    foreach ($blistarr as &$check) {
        if ($email == $check) {
            echo "Email is blacklisted.";
            return false;
        }
    }
    foreach ($unamearr as &$check) {
        if ($uname == $check[0]) {
            echo "Username is used.";
            return false;
        }
    }
    foreach ($unamearr as &$check) {
        if ($email == $check[2]) {
            echo "Email is used.";
            return false;
        }
    }
    if (strlen($pword) < 8) {
        echo "Password is too short.";
        return false;
    }
    for ($i = 0; $i < strlen($pword); $i++) {
        for ($f = 0; $f < 10; $f++) {
            if ($pword[$i] == $f) {
                $hasnum = true;
                break;
            }
        }
        if ($hasnum) break;
    }
    if (!$hasnum) {
        echo "Password does not contain a number.";
        return false;
    }
    if (!preg_match('/[\'^()}{><>,]|/', $pword)) {
        echo "Character not allowed.";
        return false;
    }
    if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email)) {
        echo "Invalid email address.";
        return false;
    }
    $newUser = $uname . '|' . $pword . '|' . $email;
    file_put_contents("./assets/userandpassword.csv", $newUser, FILE_APPEND);
    file_put_contents("./assets/userandpassword.csv", "\n", FILE_APPEND);
    return true;
}