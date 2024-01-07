<?php
// echo "Hello, world!\n";
echo "Version of PHP: " . PHP_VERSION . "\n";
// Include the external.php file
include 'external.php';
include 'batch_record.php';

// Get the current month
$currentMonth = date('M');

// Get the corresponding letter for the current month
$letterForCurrentMonth = getLetterForMonth($currentMonth);

// // Output the result
// echo "For the month of $currentMonth, the corresponding letter is $letterForCurrentMonth\n";
// Decode the JSON object
$data = json_decode($jsonObject, true);
// Get the length of the array
$arrayLength = count($data);
echo "\n$arrayLength claims\n";
// create claim file name
$newExtension=sequential_number();
// Create the new file name with the incremented extension
$sequential_number = sprintf("%03d", $newExtension);
$assigned_number = '801284';
$specialty_code = '56';
$claim_file_name = 'H' . $letterForCurrentMonth . $assigned_number . '.' . $sequential_number;
$DOS = str_replace('-', '', $data[0]['DOS']);

file_put_contents($claim_file_name, '');

$newline = batch_header($sequential_number, $assigned_number, $specialty_code,$DOS);

// Append the string to the file 
file_put_contents($claim_file_name, $newline . "\r\n", FILE_APPEND);
// Access each part of the array to print out the 'Name' value
for ($i = 0; $i < $arrayLength; $i++) {
    // echo "Name: " . $data[$i]['Name'] . "\n";
    $Accounting_Number='11100029';
    $Accounting_Number=(string)((int)$Accounting_Number + $i);
    $patient=new Patient($data[$i]);
    $newline = $patient->claim_header($Accounting_Number);

  file_put_contents($claim_file_name, $newline . "\r\n", FILE_APPEND);

    $newline = $patient->item_record();

  file_put_contents($claim_file_name, $newline . "\r\n", FILE_APPEND);
}


$H_count= str_pad((string)$arrayLength , 4, '0', STR_PAD_LEFT);
$R_count='0000';
$T_count=(string)((int)$H_count + (int)$R_count);
$T_count=str_pad($T_count, 5, '0', STR_PAD_LEFT);
$newline = batch_trailer($H_count,$R_count,$T_count);

file_put_contents($claim_file_name, $newline . "\r\n", FILE_APPEND);
// Close the file (add one line at the end
//Different characters are used to signal "EOL" (end-of-line) in different operating systems. The two most common today are \n (called "newline"), used in Unix-derived operating systems, such as Linux and Mac OS/X, and \r\n (return/newline is the old typewiter-based combination of carriage return and linefeed) used in Windows text files. 

//"\r" is ASCII code 13 (hex D), '\n' is ASCII code 10 (hex A), SUB is ASCII code 26 (hex 1A)
file_put_contents($claim_file_name,  "\x1A", FILE_APPEND);