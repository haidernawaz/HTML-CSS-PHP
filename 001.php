<?php //include 'include/config.php';?> 
<?php //include 'include/common.php';?> 
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>Book Store</title>
    <?php include 'include/css-meta.php';?> 
    
</head>

<body class="backhand_imag">
    <header>


    </header>


 <?php include 'include/nav.php';?> 
<body>
  <h2>Log In</h2>
  <div class="form_container">
  <form action="/signup" method="post">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required><br><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>
    
    <input type="submit" value="LogIn">
  </form>
</div>
</body>
 <footer>
 <?php include 'include/footer.php';?> 
 </footer> 


</html>