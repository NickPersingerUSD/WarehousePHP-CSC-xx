<?php
  include_once 'header.php';
?>

<section class="signup-form">
  <h2>Enter Your Login Information</h2>
  <div class="signup-form-form">
    <form action="includes/login.inc.php" method="post">
      
      <input type="text" name="email" placeholder="Email...">
      
      <input type="password" name="password" placeholder="Password...">
      
      <button type="submit" name="submit">Log In</button>
    </form>
  </div>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      }
     
    }
  ?>
</section>