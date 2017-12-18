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
        echo "</tr>";

        foreach($records as $record) {
            echo "<tr>";
            echo "<td>" . $record['title'] . "</td>";
            echo "<td>" . $record['author'] . "</td>";
            echo "<td>" . $record['category'] . "</td>";
            echo "<td>" . $record['year'] . "</td>";
            echo "<td>" . $record['version'] . "</td>";
            echo "<td>" . $record['bookID'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

}

function addBook($title, $author, $category, $year, $version, $bookID) {
    global $dbConn2;
    $sql = "INSERT INTO books (title, author, category, year, version, bookId)
            VALUES ('$title', '$author', '$category', '$year', '$version', '$bookID')";

    $statement= $dbConn2->prepare($sql);
    $statement->execute();
    return("
    <script>
    alert('New book added to database');
    location.replace('addBook.php');
    </script>");
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
    if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['category'])
        && isset($_POST['year']) && isset($_POST['version']) && isset($_POST['bookID'])
    ) {
        echo addBook($_POST['title'], $_POST['author'], $_POST['category'], $_POST['year'],
            $_POST['version'], $_POST['bookID']);
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
            <h1>Add new book into database</h1>
            <form action="addBook.php" method="post" class="fil">
                <input type="text" name="title" placeholder="Title">
                <input type="text" name="author" placeholder="Author">
                <select name="category">
                    <option value="Horror">Horror</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Mystery">Mystery</option>
                </select>
                <input type="text" name="year" placeholder="Year">
                <input type="text" name="version" placeholder="Version">
                <input type="text" name="bookID" placeholder="Book ID">
                <input class='link' type="submit" value="Add New Book">
            </form>
            <br><br>
            <hr><br>
            <h2><strong>Existing Books in database</strong></h2><br>
            <?= displayBook() ?>
           <br><br>
           <h2><a class='link' href="?logout" class="logout">Logout</a></h2><br/>
            <hr>
            <h5>
                <a href='administrator.php'>Back to Admin Page</a>&nbsp;&nbsp; |
                &nbsp;&nbsp;<a href='index.php'>Home</a>
            </h5>
        </main>
        </body>
        </html>
        <?php
    }
}
?>