<?php 
session_start();
//If user is already logged in, redirect them to the landing page
if(isset($_SESSION['name'])){
    header('Location: landed.php'); 
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
    $provided_email = htmlspecialchars(trim($_POST['email']));
    $provided_password = htmlspecialchars(trim($_POST['password']));
    
    
    //get the password for the user whose email was just entered
    $query = "SELECT password FROM student WHERE email = ('" . $provided_email . "');";
    $result = mysqli_query($connection, $query);
    
    
    //Make sure there were no errors retreiving the user's information
    if ($result == false){
        $message['db_error'] = "A database error occured";
    }
    
    
    //Check to see if the email which was entered by the user exists
    if (mysqli_num_rows($result) == 0) {
        $message['no_user'] = "User with email <em><strong>" . $provided_email . "</em></strong> does not exist";
    }
    
    
    //Get the password which the user entered, and compare it to the password in the database
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row['password'];
    if (password_verify ($provided_password,$stored_password) == false) {
        $message['wrong_pass'] = "The password you entered was incorrect";
    }
    
    //if no error message is present, log the user in
    if(!isset($message)){
        echo "HERE";
        session_start();
        $_SESSION['name']=$provided_email;
        header('Location: landed.php'); 
        
    }
         
  }


?>

<!DOCTYPE html>
<html>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Student Login</title>
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
        .errormessage {
            color:red;
        }
    </style>
    
    <body>
        <div id="container">
            <div id="top">
                <a href="index.html"><img src="sample.png" id="logo"></a>
            </div>
            <div id="leftSide">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h2 class="errormessage"><?php echo $message['db_error']; echo "<br>"; echo $message['no_user']; echo "<br>"; echo $message['wrong_pass']; echo "<br>";?></h2>
                    <label class="inputDesc">Email:</label> <input type="text" name="email" value="<?php echo $_POST['email'] ?>"> <br> <br>
                    <label class="inputDesc">Password:</label> <input type="password" name="password" value=""> <br> <br> <br>
                    <input  class="button" type="submit" name="submit" value="Submit"> <br>
                    <a href="forgot.php">Forgot your password? </a>
                </form>
            </div>
            <div id="rightSide">
                <img src="caduceus.png" id="caudecus">
            </div>
        </div>
    </body>
</html>