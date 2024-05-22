  <?php 
  session_start();
  include ('includes/config.php'); 
   include ('includes/common.php');
   $cpage = "register";
   if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
    header("Location: dashboard.php");
} else {
  ?> 
  <!DOCTYPE html>
  <html lang="en-US">

  <head>
      <title>Book Store</title>
      <?php include ('includes/css-meta.php');?> 
      
  </head>

  <body class="backhand_imag">

  <?php include ('includes/nav.php');
  

  if (isset($_GET["msg"])) {
      $msg = sanitizeInput($_GET["msg"]);

      if ($msg == "UKERR") {
          echo '<div class="popup">Failure: UNKNOW ERROR </div>';
      }
      if ($msg == "UAAA") {
          echo '<div class="popup">Failure: Unauthorized attempt</div>';
      }}
  ?>

    <div class="form_container">
    <h2 class="login_heading " >Sign Up</h2>
    <form action="register-action.php" method="post">
      <label for="name" class="login_form_label">Name:</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required><br><br>
      
      <label for="email" class="login_form_label">Email:</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required><br><br>
      
      <label for="password" class="login_form_label">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>


      <label for="address" class="login_form_label">Address:</label>
      <input type="text" id="address" name="address" placeholder="Enter your address" required><br><br>

      <label for="password" class="login_form_label">Phone Number:</label>
      <input type="tel" id="phone" name="phone" placeholder="+92 300 9809077" pattern="\+92\s[0-9]{3}\s[0-9]{7}"><br>
      <input type="submit" value="Register">
    </form>
  </div>
  </body>



  <footer>
  <?php include ('includes/footer.php');?> 
  </footer>

  </html>
  <?php
}
?>