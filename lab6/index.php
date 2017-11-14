<?php

session_start(); 

function loginProcess(){
    
    if(isset($_POST['loginForm'])){
        include 'database.php';
        $conn = getDataBaseConnection(); 
        
        $username = $_POST['userName'];
        $password = sha1($_POST['password']); 
    
        $sql = "SELECT * 
                FROM admin 
                WHERE userName = :userName 
                AND password = :password" ; 
        
        $namedParameters = array();
        $namedParameters[':userName'] = $userName;
        $namedParameters[':password'] = $password;
        
        $stm = $conn->prepare($sql); 
        $stm->execute($namedParameters); 
        $result = $stm->fetch(); 
        
        if (empty($result)) {
            echo "Wrong Username or password";
        } else {
            $_SESSION['userName'] = $result['userName'];
            $_SESSION['adminName'] = $result['firstName'] . "  " . $result['lastName'];
            
            header("Location: admin.php");
        }
    }
}
?>

<html>
    <head>
        <link rel="stylesheet" href="../lab6/css/styles.css" type="text/css" />
    </head>
    <body>
        <h1>- Admin Login -</h1>
        <div>
        <form method="post">
            Username<input type="userName" name="userName"/>
            <br>
            Password<input type="password" name="password"/>
            <input type="submit" name="loginForm" value="Submit"/>
        </form>
        
        <br/>
        <?=loginProcess()?>
        </div>
    </body>
</html>