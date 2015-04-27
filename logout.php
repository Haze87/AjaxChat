<?php
require_once('core.php');
session_destroy();
header('location: index.php');
?>