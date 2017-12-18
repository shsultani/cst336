<?php
session_start();
include 'database.php';
$dbConn2 = getDatabaseConnection();

function displayBook() {
    global $dbConn2;
    $sql = "SELECT * 
            FROM books
            ORDER BY title";

    $statement= $dbConn2->prepare($sql);
    $statement->execute();
    $records = $statement->fetchALL(PDO::FETCH_ASSOC);

    if (empty($records)) {
        echo "<div class='word'>Cart is empty!</div>";
    } else {
        echo "<table>";

        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Author</th>";
        echo "<th>Category</th>";
        echo "<th>Year</th>";
        echo "<th>Version</th>";
        echo "<th>Book ID</th>";
        echo "<th>Delete</th>";
        echo "</tr>";

        foreach($records as $record) {
            echo "<tr>";
            echo "<td>" . $record['title'] . "</td>";
            echo "<td>" . $record['author'] . "</td>";
            echo "<td>" . $record['category'] . "</td>";
            echo "<td>" . $record['year'] . "</td>";
            echo "<td>" . $record['version'] . "</td>";
            echo "<td>" . $record['bookID'] . "</td>";
            echo "<td><a href='#' onclick='DeleteBook(". $record['bookID'] ."); return false;'>Delete Book</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    }

}

function removeBook($toRemove) {
    global $dbConn2;
    $sql = "DELETE FROM books
            WHERE bookId = '$toRemove'";

    $statement= $dbConn2->prepare($sql);
    $statement->execute();
    return("Book with Book ID ".$toRemove." is deleted from the database");
}
if($_SESSION['logged_in'] != 1) {
    header('Location: admin.php');
    exit;
}
if(isset($_GET['logout'])) {
    $_SESSION['logged_in'] = 0;
    header('Location: admin.php');
    exit;
}else {
    if (isset($_GET['deleteISBN'])) {
        echo(removeBook($_GET['deleteISBN']));
    } else {
        ?>

        <!doctype html>
        <html lang="en">
        <head>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <title>Administrator</title>
            
    <meta charset="utf-8">

    <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    
        </head>
        <body>
        <main>
            <br>
            <h1>Delete book from database</h1>
            <?= displayBook() ?>
            <br><br>
            <h2><a class='link' href="?logout" class="logout">Logout</a></h2><br/>
            <hr>
            <h5>
                <a href='administrator.php'>Back to Admin Page</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href='index.php'>Home</a>
            </h5>
        </main>
        </body>
        <script>
            function DeleteBook(isbn) {
                isbn = pad(isbn, 10);
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                    }
                };
                xhttp.open("GET", "deleteBook.php?deleteISBN=" + isbn, true);
                xhttp.send();
                location.reload();
            }

            function pad(num, size) {
                var s = num + "";
                while (s.length < size) s = "0" + s;
                return s;
            }
        </script>
        </html>
        <?php
    }
}
?>