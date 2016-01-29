<!DOCTYPE html>
<html>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="icon" href="favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>Student Login</title>
    <style>
        
        form{
            align:center;
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
                <a href="index.html"><img src="sample.png" id="logo"></a>
            </div>
            <div id="leftSide">
                <form action="LoginHandler.php" method="post">
                    <label class="inputDesc">Email:</label> <input type="text" name="email" value=""> <br> <br>
                    <label class="inputDesc">Password:</label> <input type="password" name="password" value=""> <br> <br> <br>
                    <input  class="button" type="submit" value="Submit"> <br>
                    <a href="forgot.html">Forgot your password? </a>
                </form>
            </div>
            <div id="rightSide">
                <img src="images/caduceus.png" id="caudecus">
            </div>
        </div>
    </body>
</html>