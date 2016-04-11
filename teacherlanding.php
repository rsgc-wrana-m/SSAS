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
        
    $getClasses = "select * from Classes;";
    $classes = mysqli_query($connection, $getClasses);
        
    $classNames = array();
    $classIDs = array();
    while ($row = mysqli_fetch_array($classes)) {
    array_push($classNames, $row["classname"]);
    array_push($classIDs, $row["id"]);
    }
    
    
    
    $classNameList = array();
    
    for($i = 0; $i < count($classNames); $i++){
    
    $classNameHTML = "<form class='Link' action='".$_SERVER['PHP_SELF']."' method='POST'>
                    <input type='hidden'  name='classid' value='".$classIDs[$i]."'>
                    <input type='submit' id='phpbutton' name='classSubmit' class='butn' value='".$classNames[$i]."'>
                    </form> <br><br>";
    
    array_push($classNameList, $classNameHTML); 
    }
    
        
    }else if(isset($_SESSION['student'])){
        header('Location: studentlogin.php');
    }
    else{
        header('Location: index.html'); 
    }
    
    if(isset($_POST['classSubmit'])){
       $classID = htmlspecialchars(trim($_POST['classid']));
       
        $getStudents = "select * from student where Classes_id=".$classID.";";
        $students = mysqli_query($connection, $getStudents);
            

        //Creating three arrays, for each piece of important information needed from the student table within the database
        $id = array();
        $firstNames = array();
        $lastNames = array();
    
        //Loop through each row of the result table, extracting useful information as needed, for example: extracting the student id from each row, and placing it into a seperate array
        while ($row = mysqli_fetch_array($students)) {
            
            array_push($id, $row["id"]);
            array_push($firstNames,$row["firstname"]);
            array_push($lastNames,$row["lastname"]);
            
            
        }
        
        $students = array();
        
           for ($i = 0; $i < count($id); $i++){
               
            //getting a list of the currently active missions, for which the currently selected student is undertaking
            $getActiveMission = "select * from acceptedmission where student_id=$id[$i]";
            $activeMission = mysqli_query($connection, $getActiveMission);
            
            //If there are no active missions, with this student's id, then state that the student has no active missions
            if($activeMission->num_rows == 0){
                $currentMission = "No Mission";
                $time = "";
                $acceptButton = "";
                $failButton = "";
            }else{
                
                $acceptButton = "<input class='acceptMission' type='submit' name='completeMission' value='A'>";
                $failButton = "<input class='failMission' type='submit' name='failMission' value='F'>";
                
                //If the student is currently undertaking a mission, get the id of that mission, go to the mission list table, and retreive the name of said mission
                $activeMissionRow = mysqli_fetch_array($activeMission);
                $activeMissionID = $activeMissionRow["mission_id"];
                
                $getMissionName = "select * from mission where id=$activeMissionID";
                $missionName = mysqli_query($connection, $getMissionName);
                $missionNameRow = mysqli_fetch_array($missionName);
                $currentMission = $missionNameRow["name"];
                
                $acceptedTime = $activeMissionRow["acceptTime"];
                $missionTime = $missionNameRow['completionTIme'];
                $completionTime = $missionTime*60*60;
                
                
                $timeDue = $acceptedTime + $completionTime;
                $currentTime = time();
                $seconds = $timeDue - $currentTime;
                
                if($seconds < 0){
                    $seconds = abs($seconds);
                    
                    
                    $hours = floor($seconds / 3600);
                    $mins = floor(($seconds - $hours*3600) / 60);
                    $s = $seconds - ($hours*3600 + $mins*60);   

                    $mins = ($mins<10?"0".$mins:"".$mins);
                    $s = ($s<10?"0".$s:"".$s); 

                    $time = ($hours>0?$hours.":":"").$mins.":".$s;
                    
                    $time = "Past Due by $time";
                    
                    
                }
                else{
                    $hours = floor($seconds / 3600);
                    $mins = floor(($seconds - $hours*3600) / 60);
                    $s = $seconds - ($hours*3600 + $mins*60);   

                    $mins = ($mins<10?"0".$mins:"".$mins);
                    $s = ($s<10?"0".$s:"".$s); 

                    $time = ($hours>0?$hours.":":"").$mins.":".$s;
                }
            }
            
            
            //based on the information collected above, create a div entry that represents the student in the current position in the array
            $studentHTML =  "<form class='aStudent' action='".$_SERVER['PHP_SELF']."' method='POST'> 
            <span class='studentName'>$firstNames[$i] $lastNames[$i] - </span>
            <span class='missionStatus'>$currentMission</span>
            <span class='timeStatus'>$time</span>
            <input type='hidden' name='studentID' value='".$id[$i]."'>
            $acceptButton
            $failButton
            </form>";
            
            array_push($students, $studentHTML);
            
            
        }
       
    function compareValue($array,$value) {
        for ($i = 0; $i < count($array); $i++) {
          if($array[$i] == $value) {
              return true;
          }
        }
    } 
    
    }
    
    if(isset($_POST['completeMission'])){
        
        $studentID = htmlspecialchars(trim($_POST['studentID']));
        $getStudent = "select * from student where id=$studentID;";
        $student = mysqli_query($connection, $getStudent);
        $studentRow = mysqli_fetch_array($student);
        $coins = $studentRow['coins'];
        $pills = $studentRow['pills'];
        $envelopes = $studentRow['envelopes'];
        
        
        
        $getMission = "select * from acceptedmission where student_id=$studentID;";
        $mission = mysqli_query($connection, $getMission);
        $missionID = mysqli_fetch_array($mission)['mission_id'];
        $getMissionValues = "select * from mission where id=$missionID;";
        $missionValues = mysqli_query($connection, $getMissionValues);
        $missionValuesRow = mysqli_fetch_array($missionValues);
        $coinValue = $missionValuesRow['coinValue'];
        $pillValue = $missionValuesRow['pillValue'];
        $envelopeValue = $missionValuesRow['envelopeValue'];
        
        
        $totalCoins = $coins+$coinValue;
        $totalPills = $pills+$pillValue;
        $totalEnvelopes = $envelopes+$envelopeValue;
        
        
        $addValues = "
        UPDATE student 
        SET coins=$totalCoins,pills=$totalPills,envelopes=$totalEnvelopes
        WHERE id=$studentID;";
        
        $removeMission = "delete from acceptedmission where student_id=$studentID";
        
        if ($connection->query($addValues) === TRUE && $connection->query($removeMission) === TRUE) {
            echo "Mission Accepted";
        }else {
            echo "Error: " . $addValues . "<br>" . $connection->error;
            echo "Error: " . $removeMission . "<br>" . $connection->error;
        }
        
    }
    
    if(isset($_POST['failMission'])){
        $studentID = htmlspecialchars(trim($_POST['studentID']));
        
        $removeMission = "delete from acceptedmission where student_id=$studentID";
        
        
        if ($connection->query($removeMission) === TRUE) {
            echo "Mission Failed";
        }else {
            echo "Error: " . $removeMission . "<br>" . $connection->error;
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
        
        .timeStatus{
            padding-left:10px;
            font-size:1.5em;
            font-family: "Courier New", Courier, monospace;
        }
        
        .acceptMission{
            float:right;
            font-weight:900;
            font-size: 1.5em;
            color:green;
        }
        
        .failMission{
            float:right;
            font-weight:900;
            font-size: 1.5em;
            color:red;
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
        
    </style>
    
    <body>
        <div>
            <div id="left">
            
            <h1>
                <br><br><br>Paul Darvasi<br><br>
            </h1>
            
            <?php foreach($classNameList as $className){echo $className;}?>
            
            <h3 class="Link">
                <a href="create_mission.php" id='phpbutton'>Create Mission</a> <br><br>
            </h3>

            <h3 class="Link">
                <a href="create_class.php" id='phpbutton'>Create Class Group</a> <br><br>
            </h3>
            
            <h3 class="Link">
                <a href="create_missiontype.php" id='phpbutton'>Create Mission Type</a> <br><br>
            </h3>
            
            </div>
        
            <div id="right">
            
            <?php if(isset($_POST['classSubmit']))foreach($students as $student)echo $student;?>
            
            </div>
        
        
        </div>
    </body>
</html>