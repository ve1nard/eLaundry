<?php
session_start();

unset($_SESSION['id']);
header("Location:signin.php");
?>