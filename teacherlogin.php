<?php 
session_start();
//If user is already logged in, redirect them to the landing page
if(isset($_SESSION['teacher'])){
    header('Location: teacherlanding.php'); 
}
//Checks button presss
if(isset($_POST['submit'])){
    //Creating connection parameters for database, then connecting
    $host = "209.236.71.62";
    $user = "mrgogor3_SSASUSR";
    $pass = "price498)focal";
    $db = "mrgogor3_SSAS";
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());
    
    
    //get the email and password which the user entered
    $provided_name = htmlspecialchars(trim($_POST['uname']));
    $provided_password = htmlspecialchars(trim($_POST['password']));
    
    
    //get the password for the user whose email was just entered
    $query = "SELECT password FROM teacher WHERE name = ('" . $provided_name . "');";
    $result = mysqli_query($connection, $query);
    
    
    //Make sure there were no errors retreiving the user's information
    if ($result == false){
        $message['db_error'] = "A database error occured";
    }
    
    
    //Check to see if the email which was entered by the user exists
    if (mysqli_num_rows($result) == 0) {
        $message['no_user'] = "User with username <em><strong>" . $provided_name . "</em></strong> does not exist";
    }
    
    
    //Get the password which the user entered, and compare it to the password in the database
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row['password'];
    if ($provided_password != $stored_password) {
        $message['wrong_pass'] = "The password you entered was incorrect";
    }
    
    //if no error message is present, log the user in
    if(!isset($message)){
        echo "HERE";
        session_start();
        $_SESSION['teacher']=$provided_name;
        header('Location: teacherlanding.php'); 
        
    }
         
  }


?>

<!DOCTYPE html>
<html>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="icon" href="images/favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="main.css">
     <title>Teacher Login</title>
    <style>
        
        form{
            margin:auto;
            width:80%;
            text-align: left;
            
        }
        input{
            float:right;
            font-size: 1.5em;
        }
        label{
            font-size: 1.5em;
        }
    </style>
    <body>
        <div id="container">
            <div id="top">
                <a href="index.html"><img src="images/sample.png" id="logo"></a>
            </div>
            <div id="leftSide">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h2 class="errormessage"><?php echo $message['db_error']; echo "<br>"; echo $message['no_user']; echo "<br>"; echo $message['wrong_pass']; echo "<br>";?></h2>
                    <label class="inputDesc">Username:</label> <input type="text" name="uname" value="<?php echo $_POST['uname'] ?>"> <br> <br>
                    <label class="inputDesc">Password:</label> <input type="password" name="password" value=""> <br> <br> <br>
                    <input  class="button" type="submit" name="submit" id="phpbutton" value="Submit"> <br>
             <!--       <a href="forgot.php">Forgot your password? </a> <br> -->
                </form>
            </div>
            <div id="rightSide">
                <img src="images/caduceus.png" id="caudecus">
            </div>
        </div>
    </body>
</html>