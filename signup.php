<?php
  include_once 'header.php';
  
?>

<section class="signup-form">
  <h2>Enter Desired Account Information</h2>
  <div class="signup-form-form">
    <form action="includes/signup.inc.php" method="post">
      
      
      <input type="text" name="email" placeholder="Format: stuff@stuff.com">
      <br>
      <input type="text" name="username" placeholder="Only alphabetic characters">
      <br>
      <input type="text" name="info" placeholder="Name">
      <br>
      <input type="password" name="password" placeholder="Password">
      <br>
      <button type="submit" name="submit">Sign up</button>
    </form>
  </div>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields!</p>";
      }
      else if ($_GET["error"] == "invaliduid") {
        echo "<p>Choose a proper username!</p>";
      }
      else if ($_GET["error"] == "invalidemail") {
        echo "<p>Choose a proper email!</p>";
      }
      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong!</p>";
      }
      else if ($_GET["error"] == "emailtaken") {
        echo "<p>Email already taken!</p>";
      }
      else if ($_GET["error"] == "none") {
        echo "<p>You have signed up!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>