<?php 

session_start(); 

if(!isset($_SESSION['username'])) {
    header("Location: index.php"); 
}

function userList(){
    include 'database.php';
    $conn = getDataBaseConnection(); 
    
    $sql = "SELECT * 
            FROM user"; 
            
    $stmt = $conn->prepare($sql); 
    $stmt->execute(); 
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    
    return $records; 
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page</title>
        <script>
            function confirmDelete(){
                return confirm("Are you sure you want to delete this user?"); 
            }
        </script>
    </head>
    <body>
        <h1>Admin Main Page</h1>
        <h2>Welcome <?=$_SESSION['userName']?>!</h2>
        
        <form action="addUser.php">
            <input type="submit" value="Add new user"/>
        </form>
        
        <form action="logout.php">
            <input type="submit" value="Logout!"/>
        </form>
        
        <br/>
        
    </body>
</html>