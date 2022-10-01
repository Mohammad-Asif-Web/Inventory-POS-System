<?php
include 'functions/config.php';
session_start();
session_destroy();

header('location: http://localhost/inventory-pos-system/index.php');


?>