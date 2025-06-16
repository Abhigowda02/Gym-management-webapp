<?php
session_start();
session_destroy();
header("Location: login/admin_login.php"); // or redirect to index.php
exit();
