<?php
session_start();
$_SESSION = array();
session_destroy();
include __DIR__ . '/../view/connection.php';