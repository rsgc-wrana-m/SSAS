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
    
    $provided_email = htmlspecialchars(trim($_POST['email']));
    $provided_password = htmlspecialchars(trim($_POST['password']));
    
    
    $query = "SELECT password FROM student WHERE email = ('" . $provided_email . "');";
    $result = mysqli_query($connection, $query);
    
      if ($result == false) {
        
      echo "<p>An error occured.</p>";
      
  } else {
      if (mysqli_num_rows($result) == 0) {
        
          echo "<p>User with email <em><strong>" . $provided_email . "</em></strong> does not exist</p>";
          
      } else {
        
          // We have a result, now do the comparison of passwords
          $row = mysqli_fetch_assoc($result);
          
          $stored_password = $row['password'];
          
          if (password_verify ($provided_password,$stored_password) == true) {
              session_start();
              $_SESSION['name']=$provided_email;
              header('Location: landed.php'); 

          } else {
              echo "<p> Account with email: <em><strong>" . $provided_email . "</em></strong> entered an incorrect password</p>";
          }
      }
  }
    
    
    ?>
  </body>
  
</html>