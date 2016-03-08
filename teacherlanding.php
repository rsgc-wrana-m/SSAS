    <?php
        session_start();
        if(isset($_SESSION['name'])){
            $email = $_SESSION['name'];
        }else{
            header('Location: teacherlogin.php'); 
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
        
    </style>
    
    <script>
    function ENG4U1() {
        window.alert("ENG4U-1");
    }
    
        function ENG4U2() {
        window.alert("ENG4U-2");
    }
    
        function ENG4U3() {
        window.alert("ENG4U-3");
    }

    </script>
    
    <body>
        <div>
            <div id="left">
            
            <h1>
                <br><br><br>Paul Darvasi<br><br>
            </h1>
            
            <h3 class="Link" onClick="ENG4U1()">
                ENG4U-1 <br><br>
            </h3>
            
            <h3 class="Link" onClick="ENG4U2()">
                ENG4U-2 <br><br>
            </h3>
            
            <h3 class="Link" onClick="ENG4U3()">
                ENG4U-3 <br><br>
            </h3>
            
            <h3 class="Link">
                Create Mission <br><br>
            </h3>
            
            </div>
        
            <div id="right">
            
            <?php 
            //Creating connection parameters for database, then connecting
            $host = "209.236.71.62";
            $user = "mrgogor3_SSASUSR";
            $pass = "price498)focal";
            $db = "mrgogor3_SSAS";
            $port = 3306;
            $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());
            
            $getStudents = "select * from student";
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
            //iterating through each student in the student table, and echoing html code
            for ($i = 0; $i < count($id); $i++){
                
                //getting a list of the currently active missions, for which the currently selected student is undertaking
                $getActiveMission = "select * from acceptedmission where student_id=$id[$i]";
                $activeMission = mysqli_query($connection, $getActiveMission);
                
                //If there are no active missions, with this student's id, then state that the student has no active missions
                if($activeMission->num_rows == 0){
                    echo "here";
                    $currentMission = "No Mission";
                }else{
                    //If the student is currently undertaking a mission, get the id of that mission, go to the mission list table, and retreive the name of said mission
                    $activeMissionRow = mysqli_fetch_array($activeMission);
                    $activeMissionID = $activeMissionRow["mission_id"];
                    $getMissionName = "select * from mission where id=$activeMissionID";
                    $missionName = mysqli_query($connection, $getMissionName);
                    $missionNameRow = mysqli_fetch_array($missionName);
                    $currentMission = $missionNameRow["name"];
                }
                
                
                //based on the information collected above, create a div entry that represents the student in the current position in the array
                echo "<div class='aStudent' id='$id[$i]'> <span class='studentName'>$firstNames[$i] $lastNames[$i] - </span><span class='missionStatus'>$currentMission</span><span class='acceptMission'> A </span></div>";
                
            }
            
            
            function compareValue($array,$value) {
    for ($i = 0; $i < count($array); $i++) {
      if($array[$i] == $value) {
          return true;
          echo "true";
      }
    }
}
            ?>
            
            </div>
        
        
        </div>
    </body>
</html>