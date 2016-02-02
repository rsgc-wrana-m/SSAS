<?php 

session_start();
//Check to see if the user is already logged in
if(isset($_SESSION['name'])){
    header('Location: landed.php'); 
}
if(isset($_POST['submit'])){
    //Creating connection parameters for database, then connecting
    $host = "209.236.71.62";
    $user = "mrgogor3_SSASUSR";
    $pass = "price498)focal";
    $db = "mrgogor3_SSAS";
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());


    //Get the email which the user entered, and find them in the database
    $provided_email = htmlspecialchars(trim($_POST['email']));
    $query = "SELECT password FROM student WHERE email = ('" . $provided_email . "');";
    $result = mysqli_query($connection, $query);
    
    
    
    //Check to see if the email which was entered by the user exists
    if (mysqli_num_rows($result) == 0) {
        $message['no_user'] = "User with email <em><strong>" . $provided_email . "</em></strong> does not exist";
    }
    
    
    //If no error message is given, proceed
    if(!isset($message)){
        //Generate 6 random characters, and hash them
        $randomPassword = substr(md5(microtime()),rand(0,26),6);
        $hashedRandomPW = password_hash($randomPassword, PASSWORD_DEFAULT);
        
        
        //Create SQL UPDATE request to change password based on 6 randomly generated characters
        $updatePass = "UPDATE student SET password='". $hashedRandomPW ."' WHERE email='".$provided_email."'";
        if ($connection->query($updatePass) === TRUE) {
        //Since the password was changed, send an email to the user containing the password in plain text
            
        $content = "YOUR PASSWORD HAS BEEN RESET \n YOUR CURRENT PASSWORD IS :'" .$randomPassword."' \n IT IS HIGHLY RECCOMENDED YOU CHANGE YOUR PASSWORD AGAIN";
        mail($provided_email,"Password Reset",$content);
        
            
        }else {
            echo "Error: " . $createAccount . "<br>" . $connection->error;
        }
    }
}
    
?>

<!DOCTYPE html>
<html>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="icon" href="images/favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Forgot Password</title>
    
    <style>
        form{
            margin:auto;
            width:50%;
            text-align: left;
        }
        input{
            float:right;
            font-size: 1.5em;
        }
        label{
            font-size: 1.5em;
        }
        button{
            margin:auto;
        }
        #buttonSection{
            width:50%;
            margin:auto;
        }
        #submitted{
            margin:auto;
            display:none;
            text-align: center;
        }
    </style>
    
    
    <body>
        <div id="container">
            <div id="top">
                <a href="index.html"><img src="sample.png" id="logo"></a>
            </div>
            <br><br><br>
                <form id="emailInput" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h2><?php echo $message['no_user']?></h2>
                    <label class="inputDesc">Email associated with your account:</label> <input type="text" name="email" value="<?php echo $_POST['email'] ?>"> <br> <br> <br>
                    <input type="submit" name="submit" class="btn" value="Recover Account">
                </form>
        </div>
    </body>
</html>