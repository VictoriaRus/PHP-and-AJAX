<?php
session_start();

header('Content-Type: application/json; charset=utf-8');

require_once("Auth.php");

$auth = new Auth($_POST["login"], $_POST["password"]);
$auth->get_error_fields($auth->login, $auth->password);
$auth->user_authorization($auth->login, $auth->password);
