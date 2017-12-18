<?php
session_start();
if(!isset($_SESSION['logged_in'])) {
    $_SESSION['logged_in'] = 0;
}
include 'database.php';
$dbConn = getDatabaseConnection();

if($_SESSION['logged_in'] == 1) {
    header('Location: administrator.php');
    exit;
}else {
    if (isset($_POST['LoginForm'])) {
        $user_name = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * 
                FROM
                      admin2
                WHERE
                      user_name LIKE '$user_name' AND password LIKE '$password'";
        $statement= $dbConn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchALL(PDO::FETCH_ASSOC);

        if($statement->rowCount() > 0) {
            $_SESSION['logged_in'] = 1;
            header('Location: administrator.php');
        }else {
            echo ("<script>
            alert('Invalid Username or Password');
            location.replace('admin.php');
            </script>");
        }

    }
?>

    <!doctype html>
    <html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Login</title>
        
    <meta charset="utf-8">


    <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    </head>
    <body>
    <main><br>
        <h1>Login to Continue</h1><br>
        <div align="center" class="login"><strong>
            <form action="admin.php" method="post">
                <br />
            <br >
                Username: 
                <input type="text" name="username" placeholder="Username">
                <br /><br />
                Password: 
                <input type="password" name="password" placeholder="Password"><br /><br /><br /><br />
                <input  class='link' type="submit" name="LoginForm" value="Login"></strong>
            </form>
        </div><br />
        <hr>
            <h5>
            <a href='index.php'>Home</a>
            </h5>
            
    </main>
    </body>
    <script>
        function RemoveFrmCart(isbn) {
            isbn = pad(isbn,10);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                }
            };
            xhttp.open("GET", "cart.php?removeISBN=" + isbn, true);
            xhttp.send();
            location.reload();
        }

        function pad(num, size) {
            var s = num+"";
            while (s.length < size) s = "0" + s;
            return s;
        }
    </script>
    </html>
    <?php
}
?>