<?php
require_once 'functions.php';
if (!isset($_SESSION)) {
    redirect("../login.php");
}
session_destroy();
redirect("../login.php");
