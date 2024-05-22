
<nav class="menu">

       
<ul >
    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] && isset($_SESSION["type"]) && $_SESSION["type"]=='A') {
      ?>
    <li><a href="Dashboard.php">Dashboard</a></li>
    <li><a href="password.php">Change Password</a></li>
    <li><a href="profile.php">Update Profile</a></li>
    <li><a href="addproductt.php">Add Product</a></li>
    <li><a href="logoff.php">Log OFF</a></li>
    <!-- <li><a href="dispaly_book_record.php">Display Books</a></li> -->
      <?php
    }
    else if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] && isset($_SESSION["type"]) && $_SESSION["type"]=='U') {
      ?>
    <li><a href="Dashboard.php">Dashboard</a></li>
    <li><a href="password.php">Change Password</a></li>
    <li><a href="profile.php">Update Profile</a></li>
    <li><a href="logoff.php">Log OFF</a></li>
      <?php
    }
    
    else {
      ?>
    <li><a href="index.php">Home</a></li>

      <?php if ($cpage == "register") { ?>
        <li><a href="index.php">Login</a></li>
      <?php } ?>

      <?php if ($cpage == "login") { ?>
        <li><a href="register.php">Register</a></li>
      <?php } ?>
      <?php
    }
    ?>
  </ul>

    </nav>