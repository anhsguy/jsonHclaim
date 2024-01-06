<?php
echo "Hello, world!\n";
echo "Version of PHP: " . PHP_VERSION . "\n";
#echo phpversion();
// JSON object
$jsonObject = '[
    {"Name": "Ammar Mubarak", "HealthCard": "9686462285", "VC": "TY", "DOB": "2012-10-25", "Service": "V404", "AMT": "51.00", "DOS": "2023-12-09", "DIAG": "367"},
    {"Name": "Dana Hamzeh", "HealthCard": "8937654542", "VC": "EJ", "DOB": "2011-09-19", "Service": "V404", "AMT": "51.00", "DOS": "2023-12-09", "DIAG": "367"},
    {"Name": "Afnan Mubarak", "HealthCard": "8843349211", "VC": "LT", "DOB": "2016-11-09", "Service": "V404", "AMT": "51.00", "DOS": "2023-12-09", "DIAG": "367"},
    {"Name": "Abdullah Al-falahi", "HealthCard": "8495858469", "VC": "LT", "DOB": "2015-08-03", "Service": "V404", "AMT": "51.00", "DOS": "2023-12-09", "DIAG": "367"},
    {"Name": "Abdulazeez Mubarak", "HealthCard": "6373584884", "VC": "AJ", "DOB": "2013-12-13", "Service": "V404", "AMT": "51.00", "DOS": "2023-12-09", "DIAG": "367"},
    {"Name": "Al yamama Mubarak", "HealthCard": "5409013744", "VC": "XF", "DOB": "2015-04-01", "Service": "V404", "AMT": "51.00", "DOS": "2023-12-09", "DIAG": "367"},
    {"Name": "Sulaiman Husami", "HealthCard": "5046677851", "VC": "EY", "DOB": "2006-12-23", "Service": "V450", "AMT": "48.00", "DOS": "2023-12-09", "DIAG": "367"},
    {"Name": "Khair aldeen Hamzeh", "HealthCard": "4811796863", "VC": "GB", "DOB": "2016-05-17", "Service": "V404", "AMT": "51.00", "DOS": "2023-12-09", "DIAG": "367"},
    {"Name": "Lana Hamzeh", "HealthCard": "3491321869", "VC": "GY", "DOB": "2013-07-23", "Service": "V404", "AMT": "51.00", "DOS": "2023-12-09", "DIAG": "367"},
    {"Name": "Pujom Kansara", "HealthCard": "1485723413", "VC": "DK", "DOB": "2020-09-17", "Service": "V404", "AMT": "51.00", "DOS": "2023-12-09", "DIAG": "367"},
    {"Name": "Ibrahim Aliwi", "HealthCard": "1434762926", "VC": "JB", "DOB": "1977-04-25", "Service": "V451", "AMT": "48.00", "DOS": "2023-12-09", "DIAG": "374"}
]';
// create claim file name
$sequential_number = '014';
$assigned_number = '801284';
$specialty_code = '56';
$claim_file_name = 'H' . 'L' . $assigned_number . '.' . $sequential_number;

// Decode the JSON object
$data = json_decode($jsonObject, true);

// Get the length of the array
$arrayLength = count($data);
echo "\n$arrayLength claims\n";
$DOS = str_replace('-', '', $data[0]['DOS']);
// functions to create Batch header
function batch_header($sequential_number, $assigned_number, $specialty_code,$DOS) {
    // Generate the string
    $generated_string = 'HEB' . 'V03' . 'E' . $DOS . str_pad($sequential_number, 4, '0', STR_PAD_LEFT) . '0000000000' . $assigned_number . $specialty_code . str_repeat(' ', 42);

    return $generated_string;
}
// functions to create Claim Header-1
function claim_header_1($assigned_number, $HealthCard,$VC,$DOB,$Accounting_Number) {
    // Generate the string
    $generated_string = 'HEH' . $HealthCard . $VC . $DOB . $Accounting_Number . 'HCP' . 'P' .  str_repeat(' ', 27);

    return $generated_string;
}
// functions to create Item Record
function item_record($service_code,$fee_submitted,$DOS,$diagnostic_code) {
    // Generate the string
    $generated_string = 'HET' . $service_code . 'A' . '  ' . $fee_submitted . '01' . $DOS . $diagnostic_code . str_repeat(' ', 11);

    return $generated_string;
}
// functions to create Batch Trailer
function batch_trailer($H_count,$R_count,$T_count) {
    // Generate the string
    $generated_string = 'HEE' . $H_count . $R_count . $T_count . str_repeat(' ', 63);

    return $generated_string;
}

$result = batch_header($sequential_number, $assigned_number, $specialty_code,$DOS);

// Append the string to the file 
file_put_contents($claim_file_name, $result . PHP_EOL, FILE_APPEND);
// Access each part of the array to print out the 'Name' value
for ($i = 0; $i < $arrayLength; $i++) {
    // echo "Name: " . $data[$i]['Name'] . "\n";
    $HealthCard = $data[$i]['HealthCard'];
    $VC= $data[$i]['VC'];
    $DOB= str_replace('-', '', $data[$i]['DOB']);
    $Accounting_Number='11100029';
    $Accounting_Number=(string)((int)$Accounting_Number + 1);
    $result = claim_header_1($assigned_number, $HealthCard,$VC,$DOB,$Accounting_Number);

  file_put_contents($claim_file_name, $result . PHP_EOL, FILE_APPEND);
          
    $service_code = $data[$i]['Service'];
    $fee_submitted= str_pad(str_replace('.', '', $data[$i]['AMT']), 6, '0', STR_PAD_LEFT);
    $diagnostic_code=$data[$i]['DIAG'];
    $result = item_record($service_code,$fee_submitted,$DOS,$diagnostic_code);

  file_put_contents($claim_file_name, $result . PHP_EOL, FILE_APPEND);
}
$H_count= str_pad((string)$arrayLength , 4, '0', STR_PAD_LEFT);
$R_count='0000';
$T_count=(string)((int)$H_count + (int)$R_count);
$T_count=str_pad($T_count, 5, '0', STR_PAD_LEFT);
$result = batch_trailer($H_count,$R_count,$T_count);

file_put_contents($claim_file_name, $result . PHP_EOL, FILE_APPEND);










