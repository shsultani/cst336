<?php
include 'database.php';
$dbConn2 = getDatabaseConnection();


function displayBook() {
        session_start();
        
        $_SESSION['currentId'] = $_GET['bookID'];
        
        $bookId = $_GET['bookID'];
        
        global $id;
        $id = $bookID;
        
        global $dbConn2;
        $sql = "SELECT * 
                FROM books
                WHERE bookID LIKE '$bookID'";
                
        $statement= $dbConn2->prepare($sql); 
        $statement->execute();
        $records = $statement->fetchALL(PDO::FETCH_ASSOC); 
        
        $sql2 = "SELECT * 
                FROM checkouts
                WHERE bookID LIKE '$id'";
                
        $statement2= $dbConn2->prepare($sql2); 
        $statement2->execute();
        $records2 = $statement2->fetchALL(PDO::FETCH_ASSOC); 

        if($statement2->rowCount() > 0) {
            $status = $records2[0]['status'];
        }else {
            $status = "Available";
        }
        
        echo "<table>";
    
            echo "<tr>";
                echo "<th>Title</th>";
                echo "<th>Author</th>";
                echo "<th>Category</th>";
                echo "<th>Year</th>";
                echo "<th>Version</th>";
                echo "<th>Book ID</th>";
                echo "<th>Status</th>";
            echo "</tr>";
            
            echo "<tr>";
            echo "<td>" . $records[0]['title'] . "</td>";
            echo "<td>" . $records[0]['author'] . "</td>";
            echo "<td>" . $records[0]['catagory'] . "</td>";
            echo "<td>" . $records[0]['year'] . "</td>";
            echo "<td>" . $records[0]['version'] . "</td>";
            echo "<td>" . $records[0]['bookID'] . "</td>";
            echo "<td>" . $status . "</td>";
        echo "</tr>";
        
    echo "</table>";
    
    
}
?>

<!doctype html>
<html lang="en">
        <head>
                <link rel="stylesheet" type="text/css" href="css/style.css">
                <title>More Info</title>
                
    <meta charset="utf-8">

    <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
        </head>
        
        <main>
        <body>
            <br>
                <h1>More Info</h1><br><br>
                <?=displayBook()?>
        <br><br>
        <hr>
        <br>
        <h5>
            <?php
            if(isset($_GET['categoryFilter']) && isset($_GET['sortOrder']) && isset($_GET['greaterThan']) &&
                isset($_GET["sortOrderYear"]) && isset($_GET['versionEqualTo']) && isset($_GET['sortOrderVer'])) {

                $back_link = "categoryFilter=".$_GET['categoryFilter']."&sortOrder=".$_GET['sortOrder']."&greaterThan=".$_GET['greaterThan']."&sortOrderYear=".$_GET["sortOrderYear"]."&versionEqualTo="
                    .$_GET['versionEqualTo']."&sortOrderVer=".$_GET['sortOrderVer']."&FilterSubmit=Search";
            }else {
                $back_link = '';
            }
            ?>
        <a href='index.php?&<?php echo $back_link;?>'>Back To Search Result</a></h5>
        </body>
        </main>
</html>
