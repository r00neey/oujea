<?php
session_start(); // Start the session
session_unset();
session_destroy(); // Destroy the session
header("Location: index"); // Redirect to the login page or home page
exit(); // Ensure no further code is executed
