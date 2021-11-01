<?php

session_start();
$_SESSION = [];
unset($_SESSION);
session_destroy();

header("Location: /lab/Certification/", false, 301);
exit();