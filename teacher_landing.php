<!DOCTYPE html>
    <?php
        session_start();
        if(isset($_SESSION['name'])){
            $email = $_SESSION['name'];
        }else{
            header('Location: studentlogin.php'); 
        }
    ?>
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
        
        
        span{
          font-family: 'Raleway', sans-serif;
                      font-weight: 500;

           
            font-size: 1.9em;
            
margin-left: 20px;
        float:left;
           padding: 5px;  
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
            
            position:absolute;
            right:0;
            height:100%;
            width:59.9%;
            min-width:59.9%; 
            margin-right: 10px;
            font:16px/26px Georgia, Garamond,                               Serif;overflow:auto;
          
            float: right;
          
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
    
    function ENG4U4() {
        window.alert("ENG4U-4");
    }
    
    </script>
    <body>

        
        
        <div id="container">
            <div id="top">
                
                
            </div>
            
            
           
            
            <div id="scroll">
                    
<input type="button" class="butn" value="Student 1">
<input type="button" class="butn" value="Student 2">
<input type="button" class="butn" value="Student 3">
<input type="button" class="butn" value="Student 4">
<input type="button" class="butn" value="Student 5">
<input type="button" class="butn" value="Student 6">
<input type="button" class="butn" value="Student 7">
<input type="button" class="butn" value="Student 8">
<input type="button" class="butn" value="Student 9">            
<input type="button" class="butn" value="Student 10">            
<input type="button" class="butn" value="Student 11">            
            
            
            </div>
            
             
            
            
            
            </div>
              <div id="text">
<h3>Name:</h3>                  
<br>
<h3>Current Misions:</h3><br>
<h3>Completed Misions:</h3><br>
</div>  
        <div id="name">
            <br>
        <br>
           <h2>Paul Darvasi</h2>  
            
        </div>
         <div id="info">
             <div class="currency">
             
                 
            <span onclick="ENG4U1()">ENG4U-1</span><br>
            <span onclick="ENG4U2()">ENG4U-2</span><br>
             <span onclick="ENG4U3()">ENG4U-3</span><br>
             <span onclick="ENG4U4()">ENG4U-4</span><br>
                 <span>Create Mision</span><br>
        </div>
             
            </div>      
              
                 
                
            
           
    </body>
</html>