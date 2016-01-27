<? php 
echo "Here";
session_start();
if(isset($_SESSION['name'])){
    header('Location: landed.php'); 
}

if(isset($_POST['submit'])){
    
    //Connect to database 
    $host = "209.236.71.62";
    $user = "mrgogor3_SSASUSR";
    $pass = "price498)focal";
    $db = "mrgogor3_SSAS";
    $port = 3306;
        
    $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());
    
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
    
    if(strlen($user_email) ==0 || strpos($user_email, '@') !== false || mysqli_num_rows($result) == 0){
        $message['email']="Valid email address required"
    }
    if (strlen($user_firstname) == 0) {
        $message['firstname'] = "A first name is required.";
    }
    if (strlen($user_lastname) == 0) {
        $message['lastname'] = "A last name is required.";
    }
    if(strlen($user_password) == 0 || strlen($user_confirmpassword) == 0 || $user_password != $user_confirmpassword){
        $message['password'] = "Passwords must match";
    }
    if(compareValue($classArray,$user_classcode)){
        $message['classcode']="Must enter a valid class code";
    }
    
    if(!isset($message)){
        
        $hashedPW = password_hash($user_password, PASSWORD_DEFAULT);
        $createAccount = "INSERT INTO student (id,email,firstname,lastname,password) VALUES(DEFAULT,'". $user_email."','".$user_firstname."','".$user_lastname."','".$hashedPW."')";
        if ($connection->query($createAccount) === TRUE) {
            echo "Account Created";
        }else {
            echo "Error: " . $createAccount . "<br>" . $connection->error;
        }
        
        
    }
    
    function compareValue($array,$value){
        for ($i = 0; $i < count($array); $i++) {
          if($array[$i] == $value) return true;
      }
    }
}

?>


<!DOCTYPE html>
<html>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Register Account</title>
    <style>
        
        form{
            margin:auto;
            width:80%;
            text-align: left;
            
        }
        input{
            float:right;
            font-size: 1.2em;
            width:70%;
        }
        label{
            font-size: 1.2em;
        }
    </style>
    
    <body>
        <div id="container">
            <div id="top">
                <a href="index.html"><img src="sample.png" id="logo"></a>
            </div>
            <div id="leftSide">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <label class="inputDesc">Email:</label> <input type="text" name="email" value="<?php echo $_POST['email'] ?>"><?php echo $message['email']; ?> <br> <br>
                    <label class="inputDesc">First Name:</label> <input type="text" name="firstname" value="<?php echo $_POST['firstname'] ?>"><?php echo $message['firstname']; ?> <br> <br>
                    <label class="inputDesc">Last Name:</label> <input type="text" name="lastname" value="<?php echo $_POST['lastname'] ?>"><?php echo $message['firstname']; ?> <br> <br>
                    <label class="inputDesc">Password:</label> <input type="password" name="password" value=""><?php echo $message['password']; ?> <br> <br>
                    <label class="inputDesc">Confirm:</label> <input type="password" name="cpassword" value=""> <br> <br>
                    <label class="inputDesc">Class Code:</label> <input type="text" name="classcode" value="<?php echo $_POST['classcode'] ?>"><?php echo $message['classcode']; ?> <br> <br>
                    <input type="submit" class="btn" value="Create Account">
                </form>
            </div>
            <div id="rightSide">
                <img src="caduceus.png">
            </div>
        </div>
    </body>
</html>