<?php
  session_start();
  include_once 'includes/functions.inc.php';
?>
<?php
            if (isset($_SESSION["email"])) {
              
              
              
              
              echo "Welcome! Signed in as: " ;
              echo $_SESSION['email'];
              
              
            } ?> 
<html>
    <head>
        <title>Warehouse Game</title>
        <meta charset="UTF-8">
        <form action="index.php">
            <input type="submit" value="Homepage" />
        </form>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=anaglyph|shadow-multiple">
        
        
        
        <style>
        
          </style>
        
        <script src="start.js"></script>
    </head>
    <body >
        <audio id="audio" controls style="display:none">
  <source src="Game-Death.mp3" type="audio/mp3"> Your browser does not support the audio element.
</audio>
        
        <div id="all">
        <div> <h1 class="font-effect-shadow-multiple">Warehouse Game</h1></div>
        <div class="font-effect-shadow-multiple" id="myText">

        </div>
        <div class="font-effect-shadow-multiple" id="score"></div>
        </div>
    </body>
        <button onclick="location.href='playgame.php'" type="button">
         Restart</button>
        <br></br>
        <button onclick="location.href='playgame.php'" type="button">
         New Game</button>
        <br></br>
        <button onclick="location.href='puzzlelist.php'" type="button">
         Puzzle List</button>
</html>

