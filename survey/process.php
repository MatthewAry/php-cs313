<?php
session_start();
$_SESSION['voted'] = true;
$path = "submissions.json";

if (file_exists($path)) {
   $f = json_decode(file_get_contents($path));
   array_push($f->submissions, ((array) $_POST));
   file_put_contents($path, json_encode($f));
} else {
   $f['submissions'][] = $_POST;
   $json = json_encode($f);
   file_put_contents($path, $json);
}
?>
