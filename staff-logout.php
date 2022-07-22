<?php

session_start();
session_destroy();
header("location: staff-signin.php");