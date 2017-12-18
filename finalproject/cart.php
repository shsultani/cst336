<?php
session_start();
include 'database.php';
$dbConn2 = getDatabaseConnection();
$isbns = $_SESSION['isbns'];
function displayCart() {

    $isbns = $_SESSION['isbns'];

    $isbns = array_unique($isbns);
    $isbns = array_filter($isbns);

    global $dbConn2;

    $sql = "SELECT * 
            FROM books
            WHERE bookId IN (0";

    foreach ($isbns as $isbn) {
        $sql .= ", " . $isbn;
    }

    $sql .= ") ORDER BY title";

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
        echo "<th>Book ID </th>";
        echo "<th>Remove</th>";
        echo "</tr>";

        foreach($records as $record) {
            echo "<tr>";
            echo "<td>" . $record['title'] . "</td>";
            echo "<td>" . $record['author'] . "</td>";
            echo "<td>" . $record['catagory'] . "</td>";
            echo "<td>" . $record['year'] . "</td>";
            echo "<td>" . $record['version'] . "</td>";
            echo "<td>" . $record['bookID'] . "</td>";
            echo "<td><a href='#' onclick='RemoveFrmCart(". $record['bookID'] ."); return false;'>Remove</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    }

}

function removeCart($toRemove) {
    $_SESSION['isbns'] = array_diff($_SESSION['isbns'], array($toRemove));
    return("Book with Book ID ".$toRemove." is removed from the cart");
}

if (isset($_GET['removeISBN'])) {
    echo (removeCart($_GET['removeISBN']));
}else {
    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <title>Cart</title>
        
     <meta charset="utf-8">

    <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    </head>
    <body>
    <main>
        <h1>Cart</h1><br>
        <?= displayCart() ?>
        <br /><br>
        <hr>
        <br />
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