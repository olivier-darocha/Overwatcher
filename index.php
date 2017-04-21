<?php
error_reporting(E_ALL);
require_once 'http_request.php';
require_once 'parser_json.php';
require_once 'database_handler.php';
$id = "Haganeno-21124";
$platform = "pc";
$mode = "blob";
$request = new Request($id, $platform, $mode);
$result = $request->sendRequest();
$parsed = Parser::parse($result);

$dbhandler = new DatabaseHandler("localhost", "mydb", "root", "oth", "Haganeno-21124", "pc");
?>
