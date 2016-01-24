<html>
  <head>
    
    
  </head>
  <body>
    <h1>Result!</h1>
    <?php
    
    //Setting database parameters
      $host = "209.236.71.62";
      $user = "mrgogor3_SSASUSR";
      $pass = "price498)focal";
      $db = "mrgogor3_SSAS";
      $port = 3306;
    //Connecting to database
    $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());
    //getting user entered information to compare with database
    
    $provided_email = htmlspecialchars($_POST['email']);
    $provided_password = htmlspecialchars($_POST['password']);
    
    
    $query = "SELECT password FROM student WHERE email = ('" . $provided_email . "');";
    $result = mysqli_query($connection, $query);
    
      if ($result == false) {
        
      echo "<p>An error occured.</p>";
      
  } else {
      if (mysqli_num_rows($result) == 0) {
        
          echo "<p>user with email" . $provided_email . "does not exist</p>";
          
      } else {
        
          // We have a result, now do the comparison of passwords
          $row = mysqli_fetch_assoc($result);
          
          $stored_password = $row['password'];
        
          
          if ($stored_password == $provided_password) {
              header('Location: Student_landing.html'); 
          } else {
              echo "<p>" . $provided_email . " entered an incorrect password</p>";
          }
      }
  }
    
    
    ?>
  </body>
  
</html>