<?php
session_start();
include 'database.php';
$dbConn = getDatabaseConnection();

if($_SESSION['logged_in'] != 1) {
    header('Location: admin.php');
    exit;
}
if(isset($_GET['logout'])) {
    $_SESSION['logged_in'] = 0;
    header('Location: admin.php');
    exit;
}elseif (isset($_POST['newDueDate'])) {
    $newDueDate = $_POST['newDueDate'];
    $bookid = $_GET['bookId'];
    $sql = "UPDATE checkouts
                SET
                      dueDate = '$newDueDate'
                WHERE
                      bookId LIKE '$bookid'";
    $statement= $dbConn->prepare($sql);
    $statement->execute();
    header('Location: updateCheckout.php?bookId='.$bookid);
}elseif(isset($_GET['bookId'])) {
    $bookid = $_GET['bookId'];
    function getDetails($bookid) {
        global $dbConn;
        $sql = "SELECT *
                FROM
                      checkouts
                WHERE
                      bookId LIKE '$bookid'";

        $statement= $dbConn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchALL(PDO::FETCH_ASSOC);

        if($statement->rowCount() > 0) {
            foreach ($records as $record) {
                $book = $record['bookId'];
                $dueDate =  $record['dueDate'];
            }
            $details = $dueDate;


        }else {
            $details =  '';
        }
        return $details;
    }
    $details = getDetails($bookid);
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Admin Page</title>
        
    <meta charset="utf-8">

    <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    
    </head>
    <body>
    <main>
        <br>
        <h1> Admin Page</h1>
        <br>
        <div>
            <?php
            if($details!='') {
                echo "
                <strong style='font-size:20px'><form action='updateCheckout.php?bookId=".$_GET['bookId']."' method='post'>
                Current Due date: ".$details." <br />New due date:
                <input type='text' name='newDueDate' placeholder='yyyy-mm-dd'>
                <input class='link' type='submit' value='Update Due Date'></strong>
                ";
            }else {
                echo "
                    No book checked out for given ISBN
                ";
            }
            ?>
        </div>
        <br><br><br>
        <h2><a class='link' href="?logout" class="logout">Logout</a></h2><br />
        <hr>
        <h5>
            <a href='administrator.php'>Back to Admin Page</a>&nbsp;&nbsp; | &nbsp;&nbsp;
            <a href='index.php'>Home</a>
        </h5>
    </main>
    </body>

    </html>
    <?php
}
?>
