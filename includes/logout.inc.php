<?php

session_start();
session_unset();
session_destroy();

$message = "you have been logged out!";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='../index.php';
        </script>";

//header("location: ../index.php");
