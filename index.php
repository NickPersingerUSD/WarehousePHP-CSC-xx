<?php
  session_start();
  include_once 'includes/functions.inc.php';
?>


<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
    
<section class="index-intro">
    <link rel="stylesheet" href="css/index.css">
  <h1>Warehouse Game</h1>
  <p>Welcome to the Warehouse Game! Log-in, sign-up, or continue to play for free!</p>
</section>



<ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="puzzlelist.php">Puzzles</a></li>
          
          <?php
            if (isset($_SESSION["email"])) {
              
              echo "<li><a href='includes/logout.inc.php'>Logout</a></li>";
              echo "<br>";
              
              echo "Welcome! Signed in as: " ;
              echo $_SESSION['email'];
              
              
            }
            else {
              echo "<li><a href='signup.php'>Sign up</a></li>";
              echo "<li><a href='login.php'>Log in</a></li>";
            }
          ?>
        </ul>
               


