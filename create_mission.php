    <?php
        session_start();
        if(isset($_SESSION['name'])){
            $email = $_SESSION['name'];
        }else{
            header('Location: teacherlogin.php'); 
        }
        //Checks button press
        if(isset($_POST['submit'])){
            //Creating connection parameters for database, then connecting
            $host = "209.236.71.62";
            $user = "mrgogor3_SSASUSR";
            $pass = "price498)focal";
            $db = "mrgogor3_SSAS";
            $port = 3306;
            $connection = mysqli_connect($host, $user, $pass, $db, $port) or die(mysql_error());
        
            
            //get the four pieces of information, which the user entered
            $provided_name = htmlspecialchars(trim($_POST['missionName']));
            $provided_cat = htmlspecialchars(trim($_POST['missionCat']));
            $provided_desc = htmlspecialchars(trim($_POST['missionDesc']));
            $provided_rubric = htmlspecialchars(trim($_POST['missionRubric']));
            
            //get a list of all the currently created missions
            $getMissions = "select * from mission";
            $missions = mysqli_query($connection, $getMissions);
            
            //get a list of all the mission categories
            $getMissionTypes = "select * from missiontype";
            $missionTypes = mysqli_query($connection, $getMissionTypes);
            
            //Get a list of all the mission names that already exist
            $missionNames = array();
            while ($row = mysqli_fetch_array($missions)) {
                array_push($missionNames, $row["name"]);
            }
            
            //Get a list of all the mission types that already exist
            $missionTypeNames = array();
            while ($row = mysqli_fetch_array($missionTypes)) {
                array_push($missionTypeNames, $row["Type"]);
            }
            
            //Determine if the name the user entered already exists in the database
            if(compareValue($missionNames,$provided_name)){
                $message['name'] = "A mission with this name already exists";
                echo "here";
            }
            //Determine if the mission type the user entered exists
            if(compareValue($missionTypeNames,$provided_cat) == false){
                $message["type"] = "This mission type does not exist";
                echo "here";
            }
            
            //If all checks pass, create the mission
            if(!isset($message)){
                
                //gets the mission type id, based on the name the user entered
                
                echo $provided_cat;
                $getMissionTypeID = "select * from missiontype where Type='$provided_cat';";
                $missionTypeID = mysqli_query($connection, $getMissionTypeID);
                $missionType = mysqli_fetch_array($missionTypeID);
                $missionType2 = $missionType['id'];
                
                //Create the query, and apply it to the database, then redirect user to landing page
                $makeMission = "insert into mission(id,missiontype_id,name,description,rubric) values(DEFAULT,$missionType2,'$provided_name','$provided_desc','$provided_rubric');";
                mysqli_query($connection,$makeMission);
                header('Location: teacherlanding.php');
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
        form{
            margin:auto;
            width:80%;
            text-align: left;
                position:absolute;
    top:40%;
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
                <a href="create_mission.php">Create Mission</a> <br><br>
            </h3>
            
            </div>
        
            <div id="right">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <label class="inputDesc">Mission Name:</label><input type="text" name="missionName" value="<?php echo $_POST['missionName'] ?>"><span class="errormessage"><?php echo $message['name']; ?></span> <br><br>
                <label class="inputDesc">Mission category:</label><input type="text" name="missionCat" value="<?php echo $_POST['missionCat'] ?>"><span class="errormessage"><?php echo $message['type']; ?></span> <br><br>
                <label class="inputDesc">Mission Description (link):</label><input type="text" name="missionDesc" value="<?php echo $_POST['missionDesc'] ?>"> <br><br>
                <label class="inputDesc">Mission Rubric (link):</label><input type="text" name="missionRubric" value="<?php echo $_POST['missionRubric'] ?>"> <br><br>
                <input  class="button" type="submit" name="submit" value="Submit">
            </form>
            
            </div>
        
        
        </div>
    </body>
</html>