<?php
require_once('connection.php');

if (isset($_GET['controller']) && isset($_GET['action'])) {
   $controller = $_GET['controller'];
   $action     = $_GET['action'];
} else {
   $controller = 'identity';
   $action     = 'home';
}

$title = "experimental";
if (!isset($_GET['ajax'])) {
    require_once('views/layout.php');
} elseif (isset($_GET['ajax']) && $_GET['ajax'] == true) {
    require_once('routes.php');
}
?>
