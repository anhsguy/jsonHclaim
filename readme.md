Step 1: json object put in external.php
      make sure other number and code are correct in the .php file
Step 2: main.php - might need to change $Accounting_Number
Step 3: Run > the print out on Console
    Hello, world!
    Version of PHP: 7.4.21
    
    11 claims
    File emptied.
and HL801284.014 has the correct content

To do list:
1. $claim_file_name: the 2nd character is A-L to represant 12 month of the year (based on $DOS)
2. To have an input to initialize $Accounting_Number
3. sequence number need to increment upwards, if last file is HL801284.014, then next file is HL801284.015, until the month changes which would impact second letter.