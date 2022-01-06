<?php
session_start();

header('Content-type: application/json; charset=utf-8');

require_once("Registration.php");

$registration = new Registration($_POST["login"], $_POST["password"], $_POST["confirm_password"], $_POST["email"], $_POST["name"]);
$registration->full_fields($registration->login, $registration->password, $registration->confirm_password, $registration->email, $registration->name);
$registration->check_unique_login($registration->login);
$registration->check_unique_email($registration->email);
$registration->registration($registration->login, $registration->password, $registration->confirm_password, $registration->email, $registration->name);
