<?php
include "includes/session.php";
$_SESSION = [];
session_destroy();
header('Location: index');
exit();