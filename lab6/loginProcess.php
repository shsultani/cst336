<?php
session_start(); 

include 'database.php';
$conn = getDataBaseConnection(); 

$username = $_POST['username'];
$password = sha1($_POST['password']); 

$sql = "SELECT * 
        FROM admin 
        WHERE userName = :username 
        AND password = :password" ; 

$namedParameters = array();
$namedParameters[':username'] = $username;
$namedParameters[':password'] = $password;

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);  
$record = $statement->fetch(PDO::FETCH_ASSOC);
print_r($record);

// if (empty($result)) {
//     echo "Wrong Username or password";
// } else {
//     $_SESSION['userName'] = $result['userName'];
//     $_SESSION['adminName'] = $result['firstName'] . "  " . $result['lastName'];
    
//     header('Location: admin.php');
// }
?>