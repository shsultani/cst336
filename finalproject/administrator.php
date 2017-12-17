<?php
session_start();
if($_SESSION['logged_in'] != 1) {
    header('Location: admin.php');
    exit;
}
if(isset($_GET['logout'])) {
    $_SESSION['logged_in'] = 0;
    header('Location: admin.php');
    exit;
}else {
    include 'database.php';
    $dbConn = getDatabaseConnection('library');
    function DisplayCheckout() {
        global $dbConn;
        $sql = "SELECT * 
                FROM
                      checkouts
                ORDER BY
                      checkoutDate ASC";

        $statement= $dbConn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchALL(PDO::FETCH_ASSOC);

        if($statement->rowCount() > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>ISBN</th>";
            echo "<th>Checkout Date</th>";
            echo "<th>Due Date</th>";
            echo "<th>Status</th>";
            echo "<th>Checked out by</th>";
            echo "<th>Update</th>";
            echo "</tr>";

            foreach($records as $record) {
                echo "<tr>";
                echo "<td>" . $record['bookId'] . "</td>";
                echo "<td>" . $record['checkoutDate'] . "</td>";
                echo "<td>" . $record['dueDate'] . "</td>";
                echo "<td>" . $record['status'] . "</td>";
                echo "<td>" . $record['firstName'] ." ". $record['lastName'] . "</td>";
                echo "<td><a href='updateCheckout.php?bookId=" . $record['bookId']."'>Update due date</a></td>";
                echo "</tr>";
            }

            echo "</table>";
        }else {
            echo "No Books Checked out";
        }
    }
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
            <h1> Admin Page</h1><br>
            <h2>Update due date of books in checkout table</h2><br>
        <div>
            <?= DisplayCheckout() ?>
        </div>
        <div align="left"><br><br>
            <ul class="admin_list">
                <li>
                    <a style='font-size:20px' href="addBook.php" >Add new book into database</a>
                </li>
                <li>
                    <a style='font-size:20px' href="deleteBook.php" >Delete book from database</a>
                </li>
                <li>
                    <a style='font-size:20px' href="reports.php" >Generate some reports</a>
                </li>
            </ul>
        </div>
        <br>
        <h2><a class='link' href="?logout" class="logout">Logout</a></h2><br />
        <hr>
        <h5>
            <a href='index.php'>Home</a></h5>
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
