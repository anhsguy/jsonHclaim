<?php
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


function getLetterForMonth($month) {
    // Create an array with month names as keys and letters as values
    $letterArray = [
        'Jan' => 'A',
        'Feb' => 'B',
        'Mar' => 'C',
        'Apr' => 'D',
        'May' => 'E',
        'Jun' => 'F',
        'Jul' => 'G',
        'Aug' => 'H',
        'Sep' => 'I',
        'Oct' => 'J',
        'Nov' => 'K',
        'Dec' => 'L',
    ];

    // Get the value for the specified month
    $month = ucfirst(strtolower($month)); // Convert month to uppercase first letter
    $letter = $letterArray[$month] ?? null;

    return $letter;
}
function sequential_number() {

  // Get the list of files in the current folder
  $files = glob('*');

  // Define the pattern to match files (H followed by any character, '801284', and a dot followed by numbers)
  $pattern = '/^H[A-L]801284\.(\d+)$/';

  // Initialize the maxExtension variable to track the maximum extension
  $maxExtension = 0;

  // Iterate through the files
  foreach ($files as $file) {
      // Check if the file matches the pattern
      if (preg_match($pattern, $file, $matches)) {
          $currentExtension = (int)$matches[1];

          // Update maxExtension if the current extension is higher
          $maxExtension = max($maxExtension, $currentExtension);
      }
  }

  // Increment the highest extension by 1
  $newExtension = $maxExtension + 1;
  return $newExtension;
}




