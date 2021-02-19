<?php
include_once "session-init.php";
session_destroy();
unset($_SESSION['user_name']);

if (!empty($_SESSION)) $_SESSION = [];
if (isset($_COOKIE[session_name()])) setcookie(session_name(), "", time()-1, "/");

header('location: landing.php');
?>
