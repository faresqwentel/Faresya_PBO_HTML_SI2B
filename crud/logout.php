<?php
session_start();
session_unset();
session_destroy();

// Arahkan kembali ke index.php
header("Location: index.php");
exit;
?>