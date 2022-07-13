<?php


if (isset($_POST["submit"])){
    
    echo "success";
    
    $email = $_POST["email"];
    $tag = $_POST["username"];
    $password = $_POST["password"];
    $info = $_POST["info"];
    
    
     
    require_once "../dblogin.php";
    require_once "functions.inc.php";
    
    if (!preg_match('/^[\w.]+\@[\w.]+\.\w+$/', $email)){
        $message = "incorrect email format! example: stuff@stuff.com";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='../signup.php';
        </script>";
        exit();
    }
    
     if (!preg_match('/^[A-Za-z\s]+$/', $tag)){
        $message = "incorrect username format! example: Doug";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='../signup.php';
        </script>";
        exit();
    }
    
    
    
    if (emailExists($conn, $email) !== false){
        header("location: ../signup.php?error=emailtaken");
        exit();
    }
    if (emptyInputSignup($email, $tag, $password) !== false) {
    header("location: ../signup.php?error=emptyinput");
		exit();
    }
    createUser($conn, $tag, $info, $password, $email);
    
}
else {
    header("location: ../signup.php");
}