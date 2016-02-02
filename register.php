<!DOCTYPE html>
<html>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="icon" href="images/favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Register Account</title>
    <style>
        
        form{
            align:center;
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
<<<<<<< HEAD
                <form action="RegisterHandler.php" method="post">
                    <label class="inputDesc">Email:</label> <input type="text" name="email"> <br> <br>
                    <label class="inputDesc">First Name:</label> <input type="text" name="firstname"> <br> <br>
                    <label class="inputDesc">Last Name:</label> <input type="text" name="lastname"> <br> <br>
                    <label class="inputDesc">Password:</label> <input type="password" name="password"> <br> <br>
                    <label class="inputDesc">Confirm:</label> <input type="password" name="cpassword"> <br> <br>
                    <label class="inputDesc">Class Code:</label> <input type="text" name="classcode"> <br> <br>
                    <input type="submit" class="btn" value="Create Account">
=======
                
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="registerform">
                    <label class="inputDesc">Email:</label> <input type="text" name="email" value="<?php echo $_POST['email'] ?>"> <br><span class="errormessage"><?php echo $message['email']; ?></span> <br>
                    <label class="inputDesc">First Name:</label> <input type="text" name="firstname" value="<?php echo $_POST['firstname'] ?>"> <br> <span class="errormessage"><?php echo $message['firstname']; ?></span><br>
                    <label class="inputDesc">Last Name:</label> <input type="text" name="lastname" value="<?php echo $_POST['lastname'] ?>"> <br><span class="errormessage"><?php echo $message['lastname']; ?></span> <br>
                    <label class="inputDesc">Password:</label> <input type="password" name="password" value=""> <br> <span class="errormessage"><?php echo $message['password']; ?></span><br>
                    <label class="inputDesc">Confirm:</label> <input type="password" name="cpassword" value=""> <br> <br>
                    <label class="inputDesc">Class Code:</label> <input type="text" name="classcode" value="<?php echo $_POST['classcode'] ?>"> <br> <span class="errormessage"><?php echo $message['classcode']; ?></span><br>
                    <input type="submit" name="submit" class="btn" value="Create Account">
>>>>>>> 19b1dcf7ba4600ab5a9f1bc2e4aae1ea3c01e0eb
                </form>
            </div>
            <div id="rightSide">
                <img src="images/caduceus.png" id="caudecus">
            </div>
        </div>
    </body>
</html>