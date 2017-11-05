<?php
    include 'database.php';
    $conn = getDataBaseConnection(); 

    $sql = "SELECT * 
            FROM admin 
            WHERE userName = :username 
            AND password = :password" ; 
    
    $namedParameters = array();
    $namedParameters[':username'] = $userName;
    $namedParameters[':password'] = $password;
    
    $result = $conn->prepare($sql); 
    $result->execute($namedParameters); 
    $result = $result->fetchAll(); 
    
    if (empty($result)) {
        echo "Wrong Username or password";
    } else {
        $_SESSION['username'] = $result['username'];
        $_SESSION['adminName'] = $result['firstName'] . "  " . $result['lastName'];
        
        header("Location: admin.php");
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="../lab6/css/styles.css" type="text/css" />
    </head>
    <body>
        <h1>- Admin Login -</h1>
        <form method="POST">
            Username<input type="text" name="Username"/>
            <br>
            Password<input type="text" name="Password"/>
        <input type="submit" value="Submit"/>
        </form>
    </body>
</html>