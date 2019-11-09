<?php

session_start();
session_destroy();
setcookie('cart', "", time() - (86400 * 30));

header('Location: login.php');
