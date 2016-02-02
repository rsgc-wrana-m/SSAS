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
    
    $user_email = htmlspecialchars(trim($_POST['email']));
    $user_firstname = htmlspecialchars(trim($_POST['firstname']));
    $user_lastname = htmlspecialchars(trim($_POST['lastname']));
    $user_password = htmlspecialchars(trim($_POST['password']));
    $user_confirmpassword = htmlspecialchars(trim($_POST['cpassword']));
    $user_classcode = htmlspecialchars(trim($_POST['classcode']));
    
    $query = "SELECT email FROM student WHERE email = ('" . $user_email . "');";
    $result = mysqli_query($connection, $query);
    
    $getClasses = "SELECT * FROM class";
    $classes = mysqli_query($connection, $getClasses);
    
    $classArray = array();
    while ($row = mysqli_fetch_array($classes)) {
    array_push($classArray, $row["class"]);
    }
    
    /*
    FIX DATABASE TO REMOVE SALT AND ADD CLASS COLUMS IN TABLE STUDENT
    FIGURE OUT WAY TO SET THE ID OF A NEW STUDENT TO BE THE NEXT ON SEQUENTIALLY
    */
    
    if(mysqli_num_rows($result) == 0){
      if(strlen($user_firstname)>0 && strlen($user_lastname)>0){
        if($user_password == $user_confirmpassword && strlen($user_password)>0){
          if(compareValue($classArray,$user_classcode)){
            
            $hashedPW = password_hash($user_password, PASSWORD_DEFAULT);
            $createAccount = "INSERT INTO student (id,email,firstname,lastname,password) VALUES(DEFAULT,'". $user_email."','".$user_firstname."','".$user_lastname."','".$hashedPW."')";
            if ($connection->query($createAccount) === TRUE) {
                    echo "Account Created";
                  }else {
                    echo "Error: " . $createAccount . "<br>" . $connection->error;
                  }
          }else{
            echo "This class does not exist";
          }
        }else{
          echo "Passwords do not match";
        }
      }else{
        echo "Must Have a First and Last name";
      }
    }else{
      echo "Account with that email already exists";
    }
    
    
    function compareValue($array,$value){
        for ($i = 0; $i < count($array); $i++) {
          if($array[$i] == $value) return true;
      }
    }
    
    ?>
  </body>
  
</html>