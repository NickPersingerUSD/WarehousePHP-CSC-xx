<?php

function userExists($conn, $username) {
  $sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)) {
	 	header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt, "ss", $username, $username);
	mysqli_stmt_execute($stmt);

	// "Get result" returns the results from a prepared statement
	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
		return $row;
	}
	else {
		$result = false;
		return $result;
	}

	mysqli_stmt_close($stmt);
}
function emailExists ($conn, $email){
    $sql = "SELECT * FROM users WHERE email = ?; ";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=emailtaken");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    
    $resultData = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else {
        $result = false;
        return $result;
    }
    
    mysqli_stmt_close($stmt);
    
}

function emptyInputSignup($tag, $password, $email) {
	$result;
	if (empty($tag) || empty($password) || empty($email)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}


function createUser ($conn, $tag, $info, $password, $email) {
    //$info = "empty";
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (tag, info, password, email) VALUES ('$tag', '$info', '$password', '$email');";
    mysqli_query($conn, $sql); 
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }
    
    //$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    //mysqli_stmt_bind_param($stmt, "ssss", $tag, $info, $hashedPassword, $email);
    //mysqli_stmt_execute($stmt);
    //mysqli_stmt_close($stmt);
    header("location: ../index.php");
    exit();
}

function emptyInputLogin($email, $password){
    $result;
	if (empty($email) || empty($password)) {
		$result = true;
	}
	else {
		$result = false;
	}
	return $result;
}

function loginUser ($conn, $email, $password){
    $sql = "SELECT * from users WHERE email = '$email' AND password = '$password';";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result)==0) {   
        //die("user not found!<br />".mysqli_error($conn));
        $message = "incorrect login information!";
        echo "<script type='text/javascript'>alert('$message');
        window.location.href='../login.php';
        </script>";
        //header("location: ../login.php");
        exit();
        
    }
    
  /*  if (!$result){
        die("user not found!<br />".mysqli_error($conn));
        alert("incorrect login info!");
        header("location: ../login.php");
        exit();
    }*/
    else{
    session_start();
    $_SESSION["email"] = $email;
    header("location: ../index.php");
    }
}

function validAlphaString($s){   //all alphabetic an spaces, no spaces on ends
    $s = trim($s);
    $p = '/^[A-Za-z\s]+$/';
    return (boolean) preg_match($p,$s);
}
function validNumber($s){ //one or more digits
    $s = trim($s);
    $p = '/^\d+$/';
    return (boolean) preg_match($p,$s);
}
function validEmail($s){    // stuff@stuff.stuff  where stuff is 1 or more word chars and periods
    $s = trim($s);
    $p = '/^[\w.]+\@[\w.]+\.\w+$/';
    return (boolean) preg_match($p,$s);
}
function validPass($s){  /* all in ascii !..~  */ 
    $p='/^[!-~]+$/';
    return (boolean) preg_match($p,$s);
}