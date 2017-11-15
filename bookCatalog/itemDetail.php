<?php
function displayInfo(){
    include 'database.php';
    $conn = getDatabaseConnection();
    
    
    $sql = "SELECT *
            FROM " . $_GET["db"] . 
            " WHERE title = " . '"' . $_GET["title"] . '"';
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetch(PDO::FETCH_ASSOC);
    
    
    
    echo "Title: " . $records["title"];
    echo "<br>";
    echo "Author: " . $records["author"];
    echo "<br>";
    echo "ISBN: " . $records["ibsn"];
    echo "<br>";
    echo "Year: " . $records["year"];
    echo "<br>";
    echo "Page Count: " . $records["pages"];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <?=displayInfo()?>
    </body>
</html>