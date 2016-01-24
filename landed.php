<html>

<head>
    <style>
        body {
            text-align: center;
            
        }
    </style>
    
</head>

<body>
    <?php
    session_start();
    if(isset($_SESSION['name'])){
       $email = $_SESSION['name'];
    }else{
        header('Location: studentlogin.php'); 
    }
    
    ?>
    
    <h1><a href="aboutme.php">About Me</a></h1>
    
        <br>
        <br>
        <br>
    <form action="signout.php" method="post">
        <input  class="button" type="submit" value="Log Out"> <br>
    </form>
</body>

</html>