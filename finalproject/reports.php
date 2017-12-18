<?php
session_start();
include 'database.php';
$dbConn2 = getDatabaseConnection();

function getCount($table) {
    global $dbConn2;
    $sql = "SELECT Count(*) FROM $table";

    $statement= $dbConn2->prepare($sql);
    $statement->execute();
    $number_of_rows = $statement->fetchColumn();
    return($number_of_rows);
}

function getCountCat($category) {
    global $dbConn2;
    $sql = "SELECT Count(*) FROM books WHERE catagory LIKE '$category'";

    $statement= $dbConn2->prepare($sql);
    $statement->execute();
    $number_of_rows = $statement->fetchColumn();
    return($number_of_rows);
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
    if (isset($_GET['getNumber'])) {
        $details = getCount('books');
        echo '
            <!doctype html>
            <html>
            <head>
                <link rel="stylesheet" type="text/css" href="css/style.css">
                <title>Administrator</title>
            </head>
            <body>
            <main>
                <br>
                <h1>Total Number of books in database</h1>
                <br>
                <h2>There are <font color="red">' . $details . '</font> books in the database.</h2>
                <br>
                <h2><a class="link" href="?logout" class="logout">Logout</a></h2><br />
                <hr>
                <h5>
                <a href=\'reports.php\'>Back to Reports Page</a>&nbsp;&nbsp; |&nbsp;&nbsp;
                <a href=\'administrator.php\'>Back to Admin Page</a>&nbsp;&nbsp; |&nbsp;&nbsp;
                <a href=\'index.php\'>Home</a>
                </h5>
            </main>
            </body>
            </html>
        ';
    } elseif (isset($_GET['getCheckedNum'])) {
        $details = getCount('checkouts');
        echo '
            <!doctype html>
            <html>
            <head>
                <link rel="stylesheet" type="text/css" href="css/style.css">
                <title>Administrator</title>
            </head>
            <body>
            <main>
               <br>
                <h1>Total Number of books in database</h1><br>
                <br>
                <h2>There are <font color="red">' . $details . '</font> books in checksout table.</h2>
                <br>
                <h2><a class="link" href="?logout" class="logout">Logout</a></h2><br />
                <hr>
                <h5>
                <a href=\'reports.php\'>Back to Reports Page</a>&nbsp;&nbsp; | &nbsp;&nbsp;
                <a href=\'administrator.php\'>Back to Admin Page</a>&nbsp;&nbsp; | &nbsp;&nbsp;
                <a href=\'index.php\'>Home</a>
                </h5>
            </main>
            </body>
            </html>
        ';
    } elseif (isset($_GET['getNumberCat'])) {
        $horror = getCountCat('Horror');
        $mystery = getCountCat('Mystery');
        $fiction = getCountCat('Fiction');
        $nonfiction = getCountCat('Non-Fiction');
        echo '
            <!doctype html>
            <html>
            <head>
                <link rel="stylesheet" type="text/css" href="css/style.css">
                <title>Administrator</title>
            </head>
            <body>
            <main>
                <br>
                <h1>Report Generated</h1>
                <br>
                <h2>There are <font color="red">' . $mystery . ' </font> books in Mystery category.</h2>
                <h2>There are <font color="red">' . $nonfiction . ' </font> books in Non-Fiction category.</h2>
                <h2>There are <font color="red">' . $fiction . '</font> books in Fiction category.</h2>
                <h2>There are <font color="red">' . $horro . '</font> books in Horror category.</h2>
                <br>
                <h2><a class="link" href="?logout" class="logout">Logout</a></h2><br />
                <hr>
                <h5>
                <a href=\'reports.php\'>Back to Reports Page</a>&nbsp;&nbsp; | &nbsp;&nbsp;
                <a href=\'administrator.php\'>Back to Admin Page</a>&nbsp;&nbsp; | &nbsp;&nbsp;
                <a href=\'index.php\'>Home</a>
                </h5>
            </main>
            </body>
            </html>
        ';
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
            <h1>Generate some reports from database</h1><br><br>
            <div align="center" class="report">
                <form action="reports.php" method="get">
                    <input style="font-size:20px" type="submit" name="getNumber" value="Get total numbers of books in the database"><br/><br/>
                    <input style="font-size:20px" type="submit" name="getNumberCat" value="Get numbers of books in each category"><br/><br/>
                    <input style="font-size:20px" type="submit" name="getCheckedNum" value="Get total numbers of books checked out"><br/><br/>
                </form>
            </div>
            <br>
            <h2><a class="link" href="?logout" class="logout">Logout</a></h2><br/>
            <hr>
            <h5>
                <a href='administrator.php'>Back to Admin Page</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                <a href='index.php'>Home</a>
            </h5>
        </main>
        </body>
        </html>
        <?php
    }
}
?>