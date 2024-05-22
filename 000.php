  <?php //include 'include/config.php';?> 
  <?php //include 'include/common.php';?> 
  <!DOCTYPE html>
  <html lang="en-US">

  <head>
      <title>Book Store</title>
      <?php include 'include/css-meta.php';?> 
      
  </head>

  <body class="backhand_imag">
  <?php include 'include/nav.php';?> 
    <div class="form_container">
    <h2>Sign Up</h2>
    <form action="/signup" method="post">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" placeholder="Enter your name" required><br><br>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required><br><br>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>


      <label for="adress">Adress:</label>
      <input type="text" id="adress" name="adress" placeholder="Enter your adress" required><br><br>

      <label for="password">Phone Number:</label>
      <input type="tel" id="phone" name="phone" placeholder="+92 300 9809077" pattern="\+92\s[0-9]{3}\s[0-9]{7}"><br>
      <input type="submit" value="Register">
    </form>
  </div>
  </body>



  <footer>
  <?php include 'include/footer.php';?> 
  </footer>


  </html>