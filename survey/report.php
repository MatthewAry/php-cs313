<?php

function processResults($results) {
   $f = json_decode($results, true);
   $f = $f['submissions'];
   // Count submissions
   $submissions = count($f);

   print "<pre>";
   print_r($f);
   print "</pre>";

   $count = array();

   foreach ($f as $key => $value) {
      if (isset($count['animal'][$value['animal']])) {
         $count['animal'][$value['animal']]++;
      } else {
         $count['animal'][$value['animal']] = 1;
      }
      foreach ($value['pizza']['toppings'] as $key => $sValue) {
         if (isset($count['pizza']['toppings'][$sValue])) {
            $count['pizza']['toppings'][$sValue]++;
         } else {
            $count['pizza']['toppings'][$sValue] = 1;
         }
      }
      if (isset($count['pizza']['size'][$value['pizza']['size']])) {
         $count['pizza']['size'][$value['pizza']['size']]++;
      } else {
         $count['pizza']['size'][$value['pizza']['size']] = 1;
      }

      foreach ($value['languages'] as $key => $sValue) {
         if (isset($count['languages'][$sValue])) {
            $count['languages'][$sValue]++;
         } else {
            $count['languages'][$sValue] = 1;
         }
      }
   }
   print "<pre>";
   print_r($count);
   print "</pre>";
   print $submissions;
}



$path = "submissions.json";
if (file_exists($path)) {
   processResults(file_get_contents($path));
} else {
   echo "No data file was found.";
}


?>
