<?php

function processResults($results) {
   $f = json_decode($results, true);
   $f = $f['submissions'];
   // Count submissions
   $submissions = count($f);
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
   $count['submissions'] = count($f);
   return $count;
}

// function buildChart($count) {
//    $chart = array(
//       'animal'    => array(
//          'cols'   => array(
//             array('label'),
//          ),
//          'rows'   =>
//       ),
//       'pizza'     => array(
//          'size'      => array(
//             'cols'   => array(
//                array('label'),
//             ),
//             'rows'   =>
//          ),
//          'toppings'  => array(
//             'cols'   => array(
//                array('label'),
//             ),
//             'rows'   =>
//          )
//       ),
//       'languages' => array(
//          'cols'   => array(
//             array('label'),
//          ),
//          'rows'   =>
//       )
//    );
//
//
//
// }



$path = "submissions.json";
if (file_exists($path)) {
   echo json_encode(processResults(file_get_contents($path)));
} else {
   echo "No data file was found.";
}
?>
