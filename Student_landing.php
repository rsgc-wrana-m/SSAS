
    <?php
    
    //Creating connection parameters for database, then connecting
    $host = "209.236.71.62";
    $user = "mrgogor3_SSASUSR";
    $pass = "price498)focal";
    $db = "mrgogor3_SSAS";
    $port = 3306;
    $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());
    
    session_start();
    if(isset($_SESSION['student'])){
    $email = $_SESSION['student'];
    
    $getStudent = "select * from student where email='$email';";
    $student = mysqli_query($connection, $getStudent);
    $studentRow = mysqli_fetch_array($student);
    $coins = $studentRow['coins'];
    $pills = $studentRow['pills'];
    $envelopes = $studentRow['envelopes'];
    $firstname = $studentRow['firstname'];
    $lastname = $studentRow['lastname'];
    $StudentId = $studentRow['id'];
    
    
    
    $getSubjects = "select * from missiontype";
    $subjects = mysqli_query($connection, $getSubjects);
    
    $subjectArray = array();
    while ($row = mysqli_fetch_array($subjects)) {
        array_push($subjectArray, $row["Type"]);
    }
    
    $buttonArray = array();
    
    
    
    foreach($subjectArray as $subject){
        $buttonHTML = "<form action='".$_SERVER['PHP_SELF']."' method='POST'>
                        <input type='hidden' name='subject' value='".$subject."'>
                        <input type='submit' name='subjectSubmit' class='butn' value='".$subject."'>
                        </form>";
        
        
        
        array_push($buttonArray, $buttonHTML);
    }
    }else if(isset($_SESSION['teacher'])){
        header('Location: teacherlogin.php');
    }else{
        header('Location: index.html'); 
    }
    
    if(isset($_POST['subjectSubmit'])){
         $subject = htmlspecialchars(trim($_POST['subject']));
         
        $getSubjectID = "select * from missiontype where Type='$subject';";
        $subjectID = mysqli_query($connection, $getSubjectID);
        
        $row = mysqli_fetch_array($subjectID);
        $subjectID = $row['id'];
        
        
        
        $getMissions = "select * from mission where missiontype_id=".$subjectID.";";
        $Missions = mysqli_query($connection, $getMissions);
        
        
        
        $missionNames = array();
        $missionDescs = array();
        $missionRubrics = array();
        $missionIDs = array();
        $missionChains = array();
        
        while ($row = mysqli_fetch_array($Missions)) {
        array_push($missionNames, $row["name"]);
        array_push($missionDescs, $row["description"]);
        array_push($missionRubrics, $row["rubric"]);
        array_push($missionIDs, $row["id"]);
        array_push($missionChains, $row["chainmission_id"]);
        }
        
        $missionChains = array_unique($missionChains);
        $filteredChains = array();
        foreach ($missionChains as $row) {
            if ($row !== null)
                $filteredChains[] = $row;
            }
        $missionChains = $filteredChains;
        
        $getCompletedMissions = "select * from completedmission where student_id=$StudentId";
        $completedMissions  = mysqli_query($connection, $getCompletedMissions);
        $completedMissionIDs = array();
        while ($row = mysqli_fetch_array($completedMissions)) {
        array_push($completedMissionIDs, $row["mission_id"]);
        }
        $getCompletedMissions = null;
        $getCompletedMissions = array();
        for($i = 0;i<count($completedMissionIDs);$i++){
            $getCompletedMissions[$i] = "select * from mission where id=$completedMissionIDs[$i] and chainmission_id!=NULL";
        }
        
        
        
        $avaliableMissions = array();
        
        for($i = 0; $i < count($missionNames); $i++){
            $mission="<form id='text' action='".$_SERVER['PHP_SELF']."' method='POST'>
                <h3>Title: $missionNames[$i]</h3>
                <h3>Description:$missionDescs[$i]</h3>
                <h3>Rubric:<a href='$missionRubrics[$i]'>$missionRubrics[$i]</a></h3>
                <input type='hidden' name='missionID' value='".$missionIDs[$i]."'>
                <input type='submit' name='acceptMission' id='phpbutton' value='Accept'>
                </form>";
                
            array_push($avaliableMissions, $mission);
        }
        
    }
    
    if(isset($_POST['acceptMission'])){
        
        $getLoggedIn = "select * from student where email='".$email."';";
        $loggedIn = mysqli_query($connection, $getLoggedIn);
        
        $userID = mysqli_fetch_array($loggedIn)['id'];
        $missionID = htmlspecialchars(trim($_POST['missionID']));
        
        $getUserMissions = "select * from acceptedmission where student_id=".$userID.";";
        $UserMission = mysqli_query($connection, $getUserMissions);
        
        if($UserMission->num_rows === 0)$alreadyAccepted = false;
        else $alreadyAccepted = true;
        
    
        
        if($alreadyAccepted){
            echo "mission already accepted";
        }else{
            $addMission = "insert into acceptedmission(id,mission_id,student_id,acceptTime) values(0,".$missionID.",".$userID.",".time().");";
            
            if ($connection->query($addMission) === TRUE) {
            echo "mission accepted";
            }else {
            echo "Error: " . $createAccount . "<br>" . $connection->error;
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
                      font-weight: 500;
           
            font-size: 2em;
            margin-left: 20px;
       
            
            
        }
       
        a{
            padding-left: 10px;
            padding-right: 10px;
            font-size: 1em;
            text-decoration: none;
           
            color:rgb(21,119,204);
        }
        a:visited{
            color:rgb(21,119,204);
        }
        a:hover{
            color:#7EB3E0;
            text-decoration: underline;
        }
       
        
        #name{
            padding-top: 10%;
           img-align:middle;
            width: 20%;
           text-align: center;
           position:fixed;
         
        
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
           font-size:1em;
           
            
              margin-bottom:5px;
              
        }
        
        #phppbutton{
            -webkit-border-radius: 8;
            -moz-border-radius: 8;
            border-radius: 8px;
            color: #ffffff !important;
            background:rgb(21,119,204) ;
            padding: 9px 20px 10px 20px;
            text-decoration: none;
            border-style: hidden;
           font-size:1em;
           margin-left:-100px;
            
              margin-bottom:5px;  
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
           
            font-family: 'Raleway', sans-serif;
          
            font-family: 'Raleway', sans-serif;
            min-width: 1280px ;
            min-height: 700px;
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
            height: 70px;
            padding-top:20px;
            padding-left:35px;
            
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
  
        #text{
           
            
           
            height:100%;
            width:59.9%;
            min-width:59.9%; 
           
           
        
            float: right;
            
            border-bottom:solid black 1px;
          
        }
         
        
    </style>
    
    <body>
       
            <div id="top">
                
                
            </div>
            
            
           
            
            <div id="scroll">
            <?php foreach($buttonArray as $buttonHTML){echo $buttonHTML;}?>
            </div>
            
            <?php if(isset($_POST['subjectSubmit'])){foreach($avaliableMissions as $avaliableMission){echo $avaliableMission;}}?>
            
            </div>
        <div id="name">
            <br>
        <br>
           <h2><?php echo $firstname;echo "&nbsp;";echo $lastname;?></h2>  
            <img src="images/Coin.png" id="point">
                 
                     <h3><?php echo $coins ?></h3><br>
                 
                  
           
                       
             <img src="images/Pills.png" id="point">
                 <h3><?php echo $envelopes ?></h3><br>
                 
                   <img src="images/Envelope.png" id="point">
                 <h3><?php echo $pills ?></h3> <br>
                 <a href="signout.php" id='phppbutton'>Sign Out</a>
        </div>
        
         <div id="info">
             <div class="currency">
             
        </div>
              
            </div>      
              
                 
                
            
    
    </body>
</html>