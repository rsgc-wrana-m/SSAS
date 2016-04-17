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
        
        $provided_name = htmlspecialchars(trim($_POST['missionName']));
        $provided_cat = htmlspecialchars(trim($_POST['missionCat']));
        $provided_desc = htmlspecialchars(trim($_POST['missionDesc']));
        $provided_rubric = htmlspecialchars(trim($_POST['missionRubric']));
        $provided_coin = htmlspecialchars(trim($_POST['coinValue']));
        $provided_pill = htmlspecialchars(trim($_POST['pillValue']));
        $provided_envelope = htmlspecialchars(trim($_POST['envelopeValue']));
        $provided_time = htmlspecialchars(trim($_POST['completionTime']));
        
        $getMissions = "select * from mission";
        $Missions = mysqli_query($connection, $getMissions);
        $missionNames = array();
        while ($row = mysqli_fetch_array($Missions)) {
        array_push($missionNames, $row["name"]);
        }
        
        $getMissionCats = "select * from missiontype";
        $MissionCats = mysqli_query($connection, $getMissionCats);
        $missionCatNames = array();
        while ($row = mysqli_fetch_array($MissionCats)) {
        array_push($missionCatNames, $row["Type"]);
        }
        
        
        if(compareValue($missionNames,$provided_name)){
            $message['name'] = "A mission with this name already exists";
        }
        
        if(empty($provided_name)){
            $message['name'] = "No name provided";
        }
        
        if(compareValue($missionCatNames,$provided_cat)){
            $getTypeID = "select * from missiontype where Type = '".$provided_cat."';";
            $TypeID = mysqli_query($connection, $getTypeID);
            $TypeID = mysqli_fetch_array($TypeID)['id'];
        }else {
            $message['type'] = "A mission type with this name does not exist";
        }
        
        if(empty($provided_desc)){
            $message['desc'] = "No Description Provided";
        }
        
        if(empty($provided_rubric)){
            $message['rubric'] = "No Rubric Provided";
        }
        
        if(empty($provided_coin)){
            $message['coins'] = "No Coin Value";
        }
        
        if(empty($provided_pill)){
            $message['pills'] = "No Pill Value";
        }
        
        if(empty($provided_envelope)){
            $message['envelopes'] = "No Envelope Value";
        }
        
        if(empty($provided_time)){
            $message['time'] = "No Completion Time";
        }
        
        
        if(!isset($message)){
            $mission = "insert into mission(id,missiontype_id,name,description,rubric,coinValue,pillValue,envelopeValue,completionTime,chainmission_id,missiontier) 
            values(0,".$TypeID.",'".$provided_name."','".$provided_desc."','".$provided_rubric."',
            ".$provided_coin.",".$provided_pill.",".$provided_envelope.",".$provided_time.",NULL,NULL);";
            
            if ($connection->query($mission) === TRUE) {
            echo "mission created successfully";
            }else {
            echo "Error: " . $mission . "<br>" . $connection->error;
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
        
        
        #description{
           width:500px;
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
                <a href="create_class.php" id='phpbutton'>Create Class Group</a> <br><br>
            </h3>
            
            <h3 class="Link">
                <a href="create_missiontype.php" id='phpbutton'>Create Mission Type</a> <br><br>
                
            </h3>
             <h3 class="Link">
                <a href="chain_mission.php" id='phpbutton'>Create Chain Mission</a> <br><br>
                 
            </h3>
             <h3 class="Link">
                <a href="create_chain.php" id='phpbutton'>Create Mission Chain</a> <br><br>
                 
            <h3 class="Link">
               
                 <a href="signout.php" id='phpbutton'>Sign Out</a>
            </h3>
            
            </div>
        
            <div id="right">
            
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label class="inputDesc">Mission Name:</label><input type="text" name="missionName" value="<?php echo $_POST['missionName'] ?>"><span class="errormessage"><?php echo $message['name']; ?></span> <br><br>
                <label class="inputDesc">Mission category:</label><input type="text" name="missionCat" value="<?php echo $_POST['missionCat'] ?>"><span class="errormessage"><?php echo $message['type']; ?></span> <br><br>
                <label class="inputDesc">Mission Rubric (link):</label><input type="text" name="missionRubric" value="<?php echo $_POST['missionRubric'] ?>"><span class="errormessage"><?php echo $message['rubric']; ?></span> <br><br>
                <label class="inputDesc">Coin Value of Mission:</label><input type="text" name="coinValue" value="<?php echo $_POST['coinValue'] ?>"><span class="errormessage"><?php echo $message['coins']; ?></span> <br><br>
                <label class="inputDesc">Pill Value of Mission:</label><input type="text" name="pillValue" value="<?php echo $_POST['pillValue'] ?>"><span class="errormessage"><?php echo $message['pills']; ?></span> <br><br>
                <label class="inputDesc">Envelope Value of Mission:</label><input type="text" name="envelopeValue" value="<?php echo $_POST['envelopeValue'] ?>"><span class="errormessage"><?php echo $message['envelopes']; ?></span> <br><br>
                <label class="inputDesc">Time to Complete Mission (Hours):</label><input type="text" name="completionTime" value="<?php echo $_POST['completionTime'] ?>"><span class="errormessage"><?php echo $message['time']; ?></span> <br><br>
                <label class="inputDesc"id="description" >Mission Description:</label><input type="text" id="description" name="missionDesc" value="<?php echo $_POST['missionDesc'] ?>"><span class="errormessage"><?php echo $message['desc']; ?></span><br><br>
               
                <input  class="button" type="submit" name="submit" value="Submit" id="phpbutton">
            </form>
            
            
            </div>
        
        
        </div>
    </body>
</html>