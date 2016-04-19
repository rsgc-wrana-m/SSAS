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
    session_destroy();
    header('Location: index.html'); 
    ?>
    
    <h1>Logged Out</h1>
</body>

</html>