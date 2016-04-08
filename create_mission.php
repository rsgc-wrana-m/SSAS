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
    
    ?>
<!DOCTYPE html>
<html>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="icon" href="images/favicon.ico" type="image/gif" sizes="16x16">
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
        
        .aStudent{
            padding-top: 30px;
            padding-bottom: 30px;
            width:100%;
        }
        
        .studentName{
            float:left;
            padding-left:30px;
            font-size:1.5em;
            font-weight:700;
        }
        
        .missionStatus{
            padding-left:10px;
            font-size:1.5em;
            font-weight:700;
        }
        
        .acceptMission{
            float:right;
            padding-right:50px;
            font-weight:900;
            font-size: 1.5em;
            color:green;
        }
        
         #phpbutton{
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
        <div>
            <div id="left">
            
            <h1>
                <br><br><br>Paul Darvasi<br><br>
            </h1>
            
            <h3 class="Link">
                <a href="teacherlanding.php" id='phpbutton'>Student List</a> <br><br>
            </h3>

            <h3 class="Link">
                <a href="create_mission.php" id='activebutton'>Create Mission</a> <br><br>
            </h3>

            <h3 class="Link">
                <a href="create_mission.php" id='phpbutton'>Create Class Group</a> <br><br>
            </h3>
            
            <h3 class="Link">
                <a href="create_mission.php" id='phpbutton'>Create Mission Type</a> <br><br>
            </h3>
            
            </div>
        
            <div id="right">
            
            
            </div>
        
        
        </div>
    </body>
</html>