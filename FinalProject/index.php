<?php
session_start();
    include 'database.php';
    $conn = getDataBaseConnection(); 

// function loadBookByFilter($category, $cat_sort, $year, $year_sort, $version, $ver_sort) {
//     global $dbConn;
//     if($category == 'all') {
//         if ($year == '') {
//             if ($version == '') {
//                 $sql = "SELECT * 
//                 FROM
//                       books
//                 ORDER BY
//                       catagory $cat_sort";
//             }else {
//                 $sql = "SELECT * 
//                 FROM
//                       books
//                 WHERE
//                       version LIKE '$version'
//                 ORDER BY
//                       version $ver_sort";
//             }
//         }elseif ($version == '' && $year != '') {
//             $sql = "SELECT * 
//                 FROM
//                       books
//                 WHERE
//                       year > '$year'
//                 ORDER BY
//                       year $year_sort, version $ver_sort";
//         }else {
//             $sql = "SELECT * 
//                 FROM
//                       books
//                 WHERE
//                       version LIKE '$version' AND year > '$year'
//                 ORDER BY
//                       year $year_sort, version $ver_sort";
//         }
//     }else {
//         if ($year == '') {
//             if ($version == '') {
//                 $sql = "SELECT * 
//                 FROM
//                       books
//                 WHERE
//                       catagory LIKE '%$category%'
//                 ORDER BY
//                       catagory $cat_sort, year $year_sort, version $ver_sort";
//             }else {
//                 $sql = "SELECT * 
//                 FROM
//                       books
//                 WHERE
//                       catagory LIKE '%$category%' AND version LIKE '$version'
//                 ORDER BY
//                       catagory $cat_sort, version $ver_sort";
//             }
//         }elseif ($version == '' && $year != '') {
//             $sql = "SELECT * 
//                 FROM
//                       books
//                 WHERE
//                       catagory LIKE '%$category%' AND year > '$year'
//                 ORDER BY
//                       catagory $cat_sort, year $year_sort, version $ver_sort";
//         }else {
//             $sql = "SELECT * 
//                 FROM
//                       books
//                 WHERE
//                       catagory LIKE '%$category%' version LIKE '$version' AND year > '$year'
//                 ORDER BY
//                       catagory $cat_sort, year $year_sort, version $ver_sort";
//         }
//     }
//     // Code for $filter here, if statements.
//     $back_link = "categoryFilter=".$category."&sortOrder=".$cat_sort."&greaterThan=".$year."&sortOrderYear=".
//         $year_sort."&versionEqualTo=".$version."&sortOrderVer=".$ver_sort."&FilterSubmit=Search";
//     $statement= $dbConn->prepare($sql);
//     $statement->execute();
//     $records = $statement->fetchALL(PDO::FETCH_ASSOC);

//     if($statement->rowCount() > 0) {
//         echo "<table>";
//         echo "<tr>";
//         echo "<th>Title</th>";
//         echo "<th>Author</th>";
//         echo "<th>Category</th>";
//         echo "<th>Year</th>";
//         echo "<th>Version</th>";
//         echo "<th>ISBN</th>";
//         echo "<th></th>";
//         echo "<th></th>";
//         echo "</tr>";

//         foreach($records as $record) {
//             echo "<tr>";
//             echo "<td>" . $record['title'] . "</td>";
//             echo "<td>" . $record['author'] . "</td>";
//             echo "<td>" . $record['catagory'] . "</td>";
//             echo "<td>" . $record['year'] . "</td>";
//             echo "<td>" . $record['version'] . "</td>";
//             echo "<td>" . $record['bookId'] . "</td>";
//             echo "<td><a href='moreInfo.php?bookId=" . $record['bookId'] . "&".$back_link."'>More Info</a></td>";
//             echo "<td><a href='#' onclick='AddToCart(" .$record['bookId']. "); return false;'>Add To Cart</a></td>";
//             echo "</tr>";
//         }

//         echo "</table>";
//     }else {
//         echo "No records matching your filter";
//     }

// }

// function passData($isbn) {
//     if(isset($_SESSION['isbns'])) {
//         $isbns = $_SESSION['isbns'];
//     }else {
//         $isbns = array();
//         $_SESSION['isbns'] = array();
//     }
// }

// function display() {
//     if (isset($_GET['FilterSubmit'])) {
//         loadBookByFilter($_GET['categoryFilter'], $_GET['sortOrder'], $_GET['greaterThan'], $_GET["sortOrderYear"],
//             $_GET['versionEqualTo'], $_GET['sortOrderVer']);
//     }
// }

// function AddtoCart($book) {
//     if (in_array($book, $_SESSION['isbns'])) {
//         return("Book already in cart.");
//     }
//     global $dbConn;
//     $sql2 = "SELECT * FROM checkouts WHERE bookId = '$book'";
//     $statement2= $dbConn->prepare($sql2);
//     $statement2->execute();
//     $records2 = $statement2->fetchALL(PDO::FETCH_ASSOC);

//     if($statement2->rowCount() > 0) {
//         if ($records2[0]['status'] == "Rented") {
//             return("Book has already been checked out.");
//         }else {
//             $temp = $_SESSION['isbns'];
//             $temp[] = $book;
//             $_SESSION['isbns'] = $temp;
//             return("Book with ISBN ".$book." successfully added to cart");
//         }
//     }
//     else {
//         $temp = $_SESSION['isbns'];
//         $temp[] = $book;
//         $_SESSION['isbns'] = $temp;
//         return("Book with ISBN ".$book." successfully added to cart");
//     }
// }

// if (isset($_GET['bookISBN'])) {
//     echo(AddtoCart($_GET['bookISBN']));
// }else {
//?>

<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="Css/style.css">
        <title>Final Project</title>
        
    <meta charset="utf-8">

    <meta name="description" content="">
    <meta name="author" content="Luigi D'Antonio">
    <meta name="viewport" content="width=device-width; initial-scale=1.0">

    <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    </head>
    <img src="https://roederklaus.files.wordpress.com/2010/11/buch_lesen.gif?w=295" width="90" height="90" align="right"/>
    <img src="http://www.combatreform.org/bookani.gif" width="90" height="90" align="left"/>
          
      <main>
    <body><br>
        <h1>Library Home</h1><br>
        <?=passData("")?>
     
        <h2><a href="https://docs.google.com/a/csumb.edu/document/d/1rUOo67yyxISDikHktech7R0PvrIM76h5BLA_JDrm5KQ/edit?usp=sharing">Document Link</a>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="https://cst336-ginos89.c9users.io/phpmyadmin/index.php?db=tcp&table=user&target=tbl_sql.php&token=0ae431272fe361086e990b8af02b3ce6#PMAURL-3:sql.php?db=library&table=admin&server=1&target=&token=0ae431272fe361086e990b8af02b3ce6">Database Link</a>
        </h2>
        <h4><a href="admin.php">Administrator</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="cart.php">View Cart</a></h4>
     
        <hr>
        
        <form action="index.php" method="get" class="filter">
            <div class="cate">
            <br>
            <br>
            Category: 
            <select name="categoryFilter">
                <option value="all">All Category</option>
                <option value="Business">Business</option>
                <option value="Computer Science">Computer Science</option>
                <option value="Literature">Literature</option>
                <option value="Math">Math</option>
            </select>
            <select name="sortOrder">
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
            </select>
            <br>
            <br>
            <br>

            </div>
            
            <div class="year">
            <br>
            <br>
            Books newer than: 
            <input type="number" name="greaterThan" placeholder="Year" min="1800" max="2016">
            
            <select name="sortOrderYear">
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
            </select>
            <br>
            <br>
            <br>
            

            </div>
            
            <div class= "ver">
            <br>
            <br>
            
            Version equal to: 
            <input type="number" name="versionEqualTo" min="1" max="20">

            <select name="sortOrderVer">
                <option value="ASC">Ascending</option>
                <option value="DESC">Descending</option>
            </select>
            <br>
            <br>
            <br>
            <br>
            <input class='link' type="submit" name ="FilterSubmit" value="Search"/>
            </div>
            
        </form>
        <hr>
        <br>

        <?=display()?>
        <br><br>
        </main>
     <br><br><br><a class='link_button' href='https://cst336-ginos89.c9users.io/homepage.html'>Homepage</a>
    <footer>
    <br><br>
        <hr>
        <br> &copy; Luigi D'Antonio, 2016.
        </br>Disclaimer: The information on this page is used for academic purposes.</br>
        <img src="../../Img/csumb-logo.png" alt:"CSUMB logo"/>
    </footer>
    </body>

    <script>
        function AddToCart(isbn) {
            isbn = pad(isbn,10);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                }
            };
            xhttp.open("GET", "index.php?bookISBN="+ isbn, true);
            xhttp.send();
        }

        function pad(num, size) {
            var s = num+"";
            while (s.length < size) s = "0" + s;
            return s;
        }
    </script>

</html>
// <?php
// }?>