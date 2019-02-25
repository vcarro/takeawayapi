<?php

$csv = array_map('str_getcsv', file('restaurant.csv'));

$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$readHeader = false;
foreach ($csv as $row) {
    $i=0;
    if (!$readHeader) {
        $readHeader = true;
        foreach ($row as $field) {
            $header[$i++] = $field;
        }
        continue;
    }
    $sqlInsertStatement = 'INSERT INTO restaurant VALUES (';
    foreach ($row as $field) {
        switch ($i) {
            case 0: 
            case 10:
            case 11: 
            case 13: 
            case 14:
            case 15: 
            case 16: 
            case 17: 
            case 18: 
            case 19: 
                $sqlInsertStatement .= "$field,";
                break;
            case 20: 
                $sqlInsertStatement .= "$field,";
                break;
            case 1:
            case 2:
            case 3:
            case 4:
            case 5:
            case 6:
            case 7:
            case 8:
            case 9:
            case 12:
                $sqlInsertStatement .= "\"$field\",";
                break;
        }
        $i++;
    }
    $sqlInsertStatement .= "now(),now());";
    if ($conn->query($sqlInsertStatement) === TRUE) {
        echo "\n$sqlInsertStatement created successfully\n";
    } else {
        echo "\nError: " . $sqlInsertStatement . "<br>" . $conn->error;
    }
}

$conn->close();
