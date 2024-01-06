<?php

class Patient
{
    public $Name;
    public $HealthCard;
    public $VC;
    public $DOB;
    public $Service;
    public $AMT;
    public $DOS;
    public $DIAG;

  // Constructor to initialize the properties from an associative array
  public function __construct($data)
  {
      $this->Name = $data['Name'];
      $this->HealthCard = $data['HealthCard'];
      $this->VC = $data['VC'];
      $this->DOB = $data['DOB'];
      $this->Service = $data['Service'];
      $this->AMT = $data['AMT'];
      $this->DOS = $data['DOS'];
      $this->DIAG = $data['DIAG'];
  }
    // functions to create Claim Header-1
    function claim_header($Accounting_Number) {
        // Generate the string
        $generated_string = 'HEH' . $this->HealthCard . $this->VC . str_replace('-', '', $this->DOB) . $Accounting_Number . 'HCP' . 'P' .  str_repeat(' ', 27+17);
  
        return $generated_string;
    }
    // functions to create Item Record
    function item_record() {
        // Generate the string
        $generated_string = 'HET' . $this->Service  . 'A' . '  ' . str_pad(str_replace('.', '', $this->AMT), 6, '0', STR_PAD_LEFT) . '01' . str_replace('-', '', $this->DOS) . $this->DIAG . str_repeat(' ', 11+22+17);
  
        return $generated_string;
    }
}

// // Example usage
// $patient1 = new Patient("Ammar Mubarak", "9686462285", "TY", "2012-10-25", "V404", "51.00", "2023-12-09", "367");
// $patient2 = new Patient("Dana Hamzeh", "8937654542", "EJ", "2011-09-19", "V404", "51.00", "2023-12-09", "367");

// // Accessing properties
// echo $patient1->Name . "\n";
// echo $patient2->DOB . "\n";

// functions to create Batch header
function batch_header($sequential_number, $assigned_number, $specialty_code,$DOS) {
    // Generate the string
    $generated_string = 'HEB' . 'V03' . 'E' . $DOS . str_pad($sequential_number, 4, '0', STR_PAD_LEFT) . '0000000000' . $assigned_number . $specialty_code . str_repeat(' ', 42);

    return $generated_string;
}
// functions to create Batch Trailer
function batch_trailer($H_count,$R_count,$T_count) {
    // Generate the string
    $generated_string = 'HEE' . $H_count . $R_count . $T_count . str_repeat(' ', 63);

    return $generated_string;
}


