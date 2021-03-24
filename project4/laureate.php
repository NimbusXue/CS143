<?php
// get the id parameter from the request
$id = intval($_GET['id']);

// set the Content-Type header to JSON, so that the client knows that we are returning a JSON data
header('Content-Type: application/json');

/*
   Send the following fake JSON as the result
   {  "id": $id,
      "givenName": { "en": "A. Michael" },
      "familyName": { "en": "Spencer" },
      "affiliations": [ "UCLA", "White House" ]
   }
*/
$filter = ["id" => "$id"];
$options = ["projection" => ['_id' => 0]];

$mng = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$query = new MongoDB\Driver\Query($filter, $options);
$rows = $mng->executeQuery("nobel.laureates", $query);
foreach ($rows as $row) {
    if (!empty($rows->toArray())) {
        echo json_encode($row, JSON_PRETTY_PRINT); 
        // echo var_dump($rows);
    }
    
}  


// $output = (object) [
//     "id" => strval($id),
//     "givenName" => (object) [
//         "en" => "A. Michael"
//     ],
//     "familyName" => (object) [
//         "en" => "Spencer"
//     ],
//     "affliations" => array(
//         "UCLA",
//         "White House"
//     )
// ];
// echo json_encode($output);

?>