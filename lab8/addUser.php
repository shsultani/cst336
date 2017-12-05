<?php
    include 'database.php';
    $conn = getDataBaseConnection(); 
        
    global $conn; 
    
    $sql = "INSERT INTO users 
            (username, password, first_name, last_name, email, phone, zipCode)
            VALUES
            (:username, :password, :first_name, :last_name, :email, :phone, :zipCode)"; 
             
    $namedParameters = array();
    $namedParameters[':username']  = $_GET['username'];
    $namedParameters[':password']  = $_GET['password'];
    $namedParameters[':first_name'] = $_GET['first_name'];
    $namedParameters[':last_name']  = $_GET['last_name'];
    $namedParameters[':email']     = $_GET['email'];
    $namedParameters[':phone']     = $_GET['phone'];
    $namedParameters[':zipCode']       = $_GET['zipCode'];
    
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
    

    echo "<h1 style='font-size:450%'><center>Welcome<br><br>". "<font color='red'>" ." ' ". $_GET['first_name'] . " ' " ."</h1></font></center>";
?>
