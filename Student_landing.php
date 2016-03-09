    <?php
    session_start();
    if(isset($_SESSION['name'])){
       $email = $_SESSION['name'];
    }else{
        header('Location: studentlogin.php'); 
    }
    ?>
    

<!DOCTYPE html>
<html>
    <link href='https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link rel="icon" href="images/favicon.ico" type="image/gif" sizes="16x16">
    
    <title>RSGC SSAS</title>
    
    <style>
        
        h1{
            text-align: left;
            font-size: 6em;
            margin:0;
        }
        h2{
            font-weight: 400;
            text-align: center;
            font-size: 2em;
            margin:0;
        }
        h3{
            
            font-family: 'Raleway', sans-serif;
                      font-weight: 520;

           
            font-size: 2em;
            
margin-left: 20px;
        float:left;
            
            
        }
        #mainSection{
            align:center;
            margin:auto;
            
            width:80%;
            text-align: center;
            color:rgb(21,119,204);
            font-weight: 700;
        }
        a{
            padding-left: 10px;
            padding-right: 10px;
            font-size: 1em;
            text-decoration: none;
            text-transform: uppercase;
            color:rgb(21,119,204);
        }
        a:visited{
            color:rgb(21,119,204);
        }
        a:hover{
            color:#7EB3E0;
            text-decoration: underline;
        }
        #imageLink{
            padding:0;
        }
        
        #name{
            padding-top: 10%;
           img-align:middle;
            width: 20%;
           text-align: center;
         
        
        }
        
        
        
        .butn {
  font-family: 'Raleway', sans-serif;
   background: #ffffff;
  background-image: -webkit-linear-gradient(top, #ffffff, #ffffff);
  background-image: -moz-linear-gradient(top, #ffffff, #ffffff);
  background-image: -ms-linear-gradient(top, #ffffff, #ffffff);
  background-image: -o-linear-gradient(top, #ffffff, #ffffff);
  background-image: linear-gradient(to bottom, #ffffff, #ffffff);
  -webkit-border-radius: 0;
  -moz-border-radius: 0;
  border-radius: 0px;
  
  font-size: 33px;
  width:250px;
            height:100px;
  text-decoration: none;
}

  
        
        
        
        
        
        
        
        body{
            margin:0;
            font-family: 'Raleway', sans-serif;
            margin:0;
            font-family: 'Raleway', sans-serif;
            min-width: 1280px ;
            min-height: 700px;
            overflow:hidden;
        }
        #info{
            padding-top: 1%;
            width: 20%;
           
            float:left;
        }
        .currency{
            
            margin:auto;
            width:65%;
           
        }
        #point{
            float:left;
            text-align: left;
            display:flex;
            align-items: left;
            height: 88px;
        }
        #face{
            
            height:120px;
        }
        
        
        #scroll{
           position: absolute;
            height:100%;
            width:250px;
            min-width:250px; 
            font:16px/26px Georgia, Garamond,                               Serif;overflow:auto;
         
            margin-left: 19.6%;
        }
     textarea {
   resize: none;
}
        #text{
            overflow:auto;
            
            right:0;
            height:100%;
            width:59.9%;
            min-width:59.9%; 
            margin-right: 10px;
            font:16px/26px Georgia, Garamond,                               Serif;overflow:auto;
          
            float: right;
            
            border-bottom:solid black 1px;
          
        }
         
        
    </style>
    
    <body>
        <div id="container">
            <div id="top">
                
                
            </div>
            
            
           
            
            <div id="scroll">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="submit" name="mathSubmit" class="butn" value="Math">
                </form>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <input type="submit" name="scienceSubmit" class="butn" value="Science">
                </form>
            </div>
            
             
              
            
            
            </div>
            
    <?php
    //Creating connection parameters for database, then connecting
    $host = "209.236.71.62";
    $user = "mrgogor3_SSASUSR";
    $pass = "price498)focal";
    $db = "mrgogor3_SSAS";
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());
    
    
    //Checking to see if the math button was pressed
    if(isset($_POST['mathSubmit'])){
        //echo "Math Mission requested";
        //Get the list of missions, that apply to the type of mission the student selected
        $getMissions = "select * from mission where missiontype_id=2;";
        $missions = mysqli_query($connection, $getMissions);
        //Populate arrays of mission names, descriptions and rubrics, which can then later be used while looping the creation of each mission info
        $missionName = array();
        $missionDesc = array();
        $missionRubric = array();
        
    while ($row = mysqli_fetch_array($missions)) {
        array_push($missionName, $row["name"]);
        array_push($missionDesc, $row["description"]);
        array_push($missionRubric, $row["rubric"]);
    }
    
    for($i = 0; $i < count($missionName); $i++){
        //insert this div element into the page, changing the description, rubric, title values based on each element in the respective array
        echo " <div id='text'>
                <h3>Title:$missionName[$i]</h3>                  
                <br>
                <h3>Description:<a>$missionDesc[$i]</a></h3>
                <br>
                <h3>Rubric:<a>$missionRubric[$i]</a></h3>
                <br>
                <h2><a>Accept</a></h2>
                </div> ";
    }
        
    }
    
    if(isset($_POST['scienceSubmit'])){
        //echo "Science Mission requested";
                //Get the list of missions, that apply to the type of mission the student selected
        $getMissions = "select * from mission where missiontype_id=1;";
        $missions = mysqli_query($connection, $getMissions);
        //Populate arrays of mission names, descriptions and rubrics, which can then later be used while looping the creation of each mission info
        $missionName = array();
        $missionDesc = array();
        $missionRubric = array();
        
    while ($row = mysqli_fetch_array($missions)) {
        array_push($missionName, $row["name"]);
        array_push($missionDesc, $row["description"]);
        array_push($missionRubric, $row["rubric"]);
    }
    
    for($i = 0; $i < count($missionName); $i++){
        //insert this div element into the page, changing the description, rubric, title values based on each element in the respective array
        echo " <div id='text'>
                <h3>Title:$missionName[$i]</h3>                  
                <br>
                <h3>Description:<a>$missionDesc[$i]</a></h3>
                <br>
                <h3>Rubric:<a>$missionRubric[$i]</a></h3>
                <br>
                <h2><a>Accept</a></h2>
                </div> ";
    }
        
    }
    
    ?>
        <div id="name">
            <br>
        <br>
           <h2>Michael Wrana</h2>  
            
        </div>
         <div id="info">
             <div class="currency">
             <img src="images/Coin.png" id="point">
                 
                     <h3>500</h3>
                 
                  
             <img src="images/Envelope.png" id="point">
                 <h3>50</h3> <br>
                       
             <img src="images/Pills.png" id="point">
                 <h3>5</h3>
        </div>
             
            </div>      
              
                 
                
            
           
    </body>
</html>