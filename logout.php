<?php
session_start();

/* Remove all session variables */
$_SESSION = [];

/* Destroy the session */
session_destroy();

/* Redirect back to index page */
header("Location: index.php");
exit();
