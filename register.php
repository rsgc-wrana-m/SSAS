<?php 
session_start();
//Check to see if the user is already logged in
if(isset($_SESSION['name'])){
    header('Location: teacherindex.php'); 
}
//Checks button press
if(isset($_POST['submit'])){
    //Creating connection parameters for database, then connecting
    $host = "209.236.71.62";
    $user = "mrgogor3_SSASUSR";
    $pass = "price498)focal";
    $db = "mrgogor3_SSAS";
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());
    
    
    //Getting the information the user entered into the form, trimming off whitespace, and protecting agaist sql injection
    $user_email = htmlspecialchars(trim($_POST['email']));
    $user_firstname = htmlspecialchars(trim($_POST['firstname']));
    $user_lastname = htmlspecialchars(trim($_POST['lastname']));
    $user_password = htmlspecialchars(trim($_POST['password']));
    $user_confirmpassword = htmlspecialchars(trim($_POST['cpassword']));
    $user_classcode = htmlspecialchars(trim($_POST['classcode']));
    
    
    //Getting a list of all the user accounts that use the same email as the one THIS user entered
    $query = "SELECT email FROM student WHERE email = ('" . $user_email . "');";
    $result = mysqli_query($connection, $query);
    
    
    //Getting a list of all the current class names, and moving them into an array called $classArray
    $getClasses = "SELECT * FROM Classes";
    $classes = mysqli_query($connection, $getClasses);
    $classArray = array();
    while ($row = mysqli_fetch_array($classes)) {
        array_push($classArray, $row["classname"]);
    }
    //Checking to see if the user entered their email, making sure it has an @, and checking whether a user with that email already exists
    if(strlen($user_email) == 0 || mysqli_num_rows($result) !== 0 || strpos($user_email, '@') == FALSE) {
        $message['email']="Invalid email";
    }
    
    
    //Checking to see if the user entered a first name
    if (strlen($user_firstname) == 0) {
        $message['firstname'] = "A first name is required.";
    }
    
    
    //Checking to see if the user entered a last name
    if (strlen($user_lastname) == 0) {
        $message['lastname'] = "A last name is required.";
    }
    
    
    //Checking if the user entered a password, and a confirmation, and making sure they are the same
    if(strlen($user_password) == 0 || strlen($user_confirmpassword) == 0 || $user_password != $user_confirmpassword){
        $message['password'] = "Passwords must match";
    }
    
    
    //Checking if the class code entered by the user exists in the database
    if(!compareValue($classArray,$user_classcode)){
        $message['classcode']="Invalid class code";
    }
    
    //echo $classArray;
    
    //Checking to see if any part of the $message array is filled, if no part is filled, enter the user into database
    if(!isset($message)){
        //Hashing the user's password
        $hashedPW = password_hash($user_password, PASSWORD_DEFAULT);
        
        $getUserClass = "SELECT * FROM Classes WHERE classname='".$user_classcode."';";
        $userClass = mysqli_query($connection, $getUserClass);
        $userClassID = mysqli_fetch_array($userClass)['id'];
        
        //sql query that inserts the user into our database based on the information given
       
       
       $createAccount = "INSERT INTO student (id,Classes_id,email,firstname,lastname,password) VALUES(DEFAULT,".$userClassID.",'". $user_email."','".$user_firstname."','".$user_lastname."','".$hashedPW."')";
        
        //If the account was created successfully, echo account created, otherwise echo the error recieved by the sql server
        if ($connection->query($createAccount) === TRUE) {
            //header('Location: studentlogin.php');
        }else {
            echo "Error: " . $createAccount . "<br>" . $connection->error;
        }
        
        
    }
    

}
//Iterates through each element of an array, and compares the value to $value (For strings)
function compareValue($array,$value) {
    for ($i = 0; $i < count($array); $i++) {
      if($array[$i] == $value) {
          return true;
          echo "true";
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
        .errormessage {
            color:red;
            font-weight:500;
        }
        #created {
            color:green;
            font-weight: 700;
            font-size:1.5em;
        }
    </style>
    
    <body>
        <div id="container">
            <div id="top">
                <a href="index.html"><img src="images/sample.pngsample.png" id="logo"></a>
            </div>
            <div id="leftSide">
                
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="registerform">
                    <label class="inputDesc">Email:</label> <input type="text" name="email" value="<?php echo $_POST['email'] ?>"> <br><span class="errormessage"><?php echo $message['email']; ?></span> <br>
                    <label class="inputDesc">First Name:</label> <input type="text" name="firstname" value="<?php echo $_POST['firstname'] ?>"> <br> <span class="errormessage"><?php echo $message['firstname']; ?></span><br>
                    <label class="inputDesc">Last Name:</label> <input type="text" name="lastname" value="<?php echo $_POST['lastname'] ?>"> <br><span class="errormessage"><?php echo $message['lastname']; ?></span> <br>
                    <label class="inputDesc">Password:</label> <input type="password" name="password" value=""> <br> <span class="errormessage"><?php echo $message['password']; ?></span><br>
                    <label class="inputDesc">Confirm:</label> <input type="password" name="cpassword" value=""> <br> <br>
                    <label class="inputDesc">Class Code:</label> <input type="text" name="classcode" value="<?php echo $_POST['classcode'] ?>"> <br> <span class="errormessage"><?php echo $message['classcode']; ?></span><br>
                    <input type="submit" name="submit" class="btn" value="Create Account">
                </form>
            </div>
            <div id="rightSide">
                <img src="images/caduceus.png" id="caduceus">
            </div>
        </div>
    </body>
</html>