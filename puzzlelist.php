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
        <meta charset="UTF-8">
        <form action="index.php">
            <input type="submit" value="Homepage" />
        </form>
        <title>Warehouse Puzzles</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=anaglyph|shadow-multiple">
    </head>
    <body>
        <h1 class="font-effect-shadow-multiple">Warehouse Puzzles</h1>
        <h2 class="font-effect-shadow-multiple"> Puzzle = = = Player = = = Score </h2>
        <ul>
            
                     
              
        <?php
        
            require('dblogin.php');  //download or copy: defines $db_host,...,$db_name
            $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
            if(!$conn){ 
		die("could not connect to db: <br />".mysqli_error($conn));
            }
            //print " Successful connection!!";
    
        $q = "SELECT * FROM `puzzles`";      //a very simple query. NOTE the funky ` tick marks NOT '
	$result = mysqli_query($conn, $q);           //making the query
	if(!$result){ 
            die("query failed: <br />".mysqli_error($conn));}
        
        
            
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$puz = $row['puzname'];    //Yes arrays are maps. puzname is a column name
                $nm  = $row['name'];
                $sc = $row['score'];
                
                print "<li> <a href='playgame.php'>$puz</a> = = = $nm = = = $sc </li>";
           }

        ?>
        </ul>
    </body>
</html>
