    <?php
    //Creating connection parameters for database, then connecting
    $host = "209.236.71.62";
    $user = "mrgogor3_SSASUSR";
    $pass = "price498)focal";
    $db = "mrgogor3_SSAS";
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());
    
    session_start();
    if(isset($_SESSION['teacher'])){
        $username = $_SESSION['teacher'];
        
    }else if(isset($_SESSION['student'])){
        header('Location: studentlogin.php');
    }else{
        header('Location: index.html'); 
    }
    
    if(isset($_POST['submit'])){
        $provided_name = htmlspecialchars(trim($_POST['chainName']));
        
        $getChains = "select * from chainmission";
        $chains = mysqli_query($connection, $getChains);
        $chainNames = array();
        while ($row = mysqli_fetch_array($chains)) {
        array_push($chainNames, $row["name"]);
        }
        
        if(compareValue($chainNames,$provided_name)){
            $message = "A chain with this name already exists";
        }
        
        if(empty($provided_name)){
            $message = "No name provided";
        }
        
        if(!isset($message)){
            $addChain = "insert into chainmission(id,name) values(0,'".$provided_name."');";
            
            if ($connection->query($addChain) === TRUE) {
            echo "chain created successfully";
            }else {
            echo "Error: " . $addChain . "<br>" . $connection->error;
            }
        }
        
    }
    
    function compareValue($array,$value) {
        for ($i = 0; $i < count($array); $i++) {
          if($array[$i] == $value) {
              return true;
          }
        }
    } 
    ?>
<!DOCTYPE html>
<html>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="icon" href="images/favicon.ico" type="image/gif" sizes="16x16">
    <link rel="stylesheet" type="text/css" href="main.css">
    <title>RSGC SSAS</title>
    <style>
        body{
            margin:0;
              font-family: 'Raleway', sans-serif;
        }
        #left{
           width: 25%;
           position: absolute;
           left: 0px;
           height: 100%;
           text-align:center;
        }
        
        #right{
           width: 75%;
           position: absolute;
           right: 0px;
           height: 100%;
        }
        
        .Link{
            color:blue;
        }
        
        form{
            margin:auto;
            width:80%;
            text-align: left;
            position:absolute;
            top:25%;
            right:0;
            left:0;
        }
        input{
            float:right;
            font-size: 1.5em;
        }
        label{
            font-size: 1.5em;
        }
        
         #phpbutton{
             display:inline-block;
             width:220px;
            -webkit-border-radius: 8;
            -moz-border-radius: 8;
            border-radius: 8px;
            color: #ffffff !important;
            background:rgb(21,119,204) ;
            padding: 9px 20px 10px 20px;
            text-decoration: none;
            border-style: hidden;
        }
        
        #activebutton{
              display:inline-block;
             width:220px;
            -webkit-border-radius: 8;
            -moz-border-radius: 8;
            border-radius: 8px;
            color: #ffffff !important;
            background:#151BCD ;
            padding: 9px 20px 10px 20px;
            text-decoration: none;
            border-style: hidden;
        }
        
    </style>
    
    <body>
        <div id="container">
            <div id="left">
            
            <h1>
                <br><br><br>Paul Darvasi<br><br>
            </h1>
            
            <h3 class="Link">
                <a href="teacherlanding.php" id='phpbutton'>Student List</a> <br><br>
            </h3>

            <h3 class="Link">
                <a href="create_mission.php" id='phpbutton'>Create Mission</a> <br><br>
            </h3>

            <h3 class="Link">
                <a href="create_class.php" id='phpbutton'>Create Class Group</a> <br><br>
            </h3>
            
            <h3 class="Link">
                <a href="create_missiontype.php" id='phpbutton'>Create Mission Type</a> <br><br>
                
            </h3>
            <h3 class="Link">
                <a href="chain_mission.php" id='phpbutton'>Create Chain Mission</a> <br><br>
                 
            </h3>
            <h3 class="Link">
                <a href="create_chain.php" id='activebutton'>Create Mission Chain</a> <br><br>
                 
            </h3>
            <h3 class="Link">
               
                 <a href="signout.php" id='phpbutton'>Sign Out</a>
            </h3>
             
            </div>
        
            <div id="right">
            
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label class="inputDesc">Chain Name:</label><input type="text" name="chainName" value="<?php echo $_POST['chainName'] ?>"><span class="errormessage"><?php echo $message; ?></span> <br><br>
                <input  class="button" type="submit" name="submit" value="Submit" id="phpbutton">
            </form>
            
            </div>
        
        
        </div>
    </body>
</html>