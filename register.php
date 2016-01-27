<!DOCTYPE html>
<html>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
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
                <form action="RegisterHandler.php" method="post">
                    <label class="inputDesc">Email:</label> <input type="text" name="email"> <br> <br>
                    <label class="inputDesc">First Name:</label> <input type="text" name="firstname"> <br> <br>
                    <label class="inputDesc">Last Name:</label> <input type="text" name="lastname"> <br> <br>
                    <label class="inputDesc">Password:</label> <input type="password" name="password"> <br> <br>
                    <label class="inputDesc">Confirm:</label> <input type="password" name="cpassword"> <br> <br>
                    <label class="inputDesc">Class Code:</label> <input type="text" name="classcode"> <br> <br>
                    <input type="submit" class="btn" value="Create Account">
                </form>
            </div>
            <div id="rightSide">
                <img src="caduceus.png" id="caudecus">
            </div>
        </div>
    </body>
</html>