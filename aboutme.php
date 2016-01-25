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
        
         $host = "209.236.71.62";
         $user = "mrgogor3_SSASUSR";
         $pass = "price498)focal";
         $db = "mrgogor3_SSAS";
         $port = 3306;
         //Connecting to database
        $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());
        
        $query = "SELECT * FROM student WHERE email = ('" . $email . "');";
        $db_result = mysqli_query($connection, $query);
        
        $result = mysqli_fetch_assoc($db_result);
        
        echo "Your User id is:" . $result['id'] . "<br>" ;
        echo "Your Email is:" . $result['email'] . "<br>" ;
        echo "Your First Name is:" . $result['firstname'] . "<br>" ;
        echo "Your Last Name is:" . $result['lastname'] . "<br>" ;
        
        
    }else{
        header('Location: studentlogin.php'); 
    }
    
    ?>

    <form action="signout.php" method="post">
        <input  class="button" type="submit" value="Log Out"> <br>
    </form>
</body>

</html>