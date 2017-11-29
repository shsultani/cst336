<?php
    include 'database.php';
    $conn = getDatabaseConnection();

    function notFromUSA(){
        global $conn;
        
        $sql = "SELECT firstName, lastName, country_of_birth 
                FROM `celebrity` 
                WHERE gender=\"F\" 
                AND country_of_birth!=\"USA\" 
                ORDER BY lastName ASC";
                
        $stm = $conn->prepare($sql); 
        $stm->execute();
        $record = $stm->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr>";
        echo "<th>firstName</th>";
        echo "<th>lastName</th>";
        echo "<th>country_of_birth"; 
        echo "</tr>";
        
        foreach($record as $records) {
        echo "<tr>";
        echo "<td>" . $records['firstName'] . "</td>";
        echo "<td>" . $records['lastName'] . "</td>";
        echo "<td>" . $records['country_of_birth'] . "</td>"; 
        echo "</tr>";
        }
        echo "</table>";
    }
    
    function movieAvgDuration(){
        global $conn;
        
        $sql = "SELECT movie_category, count(movie_title) AS number_of_movies, avg(duration) AS avg_duration 
        FROM movie 
        GROUP BY movie_category";

                
        $stm= $conn->prepare($sql); 
        $stm->execute();
        $record = $stm->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr>";
        echo "<th>Category</th>";
        echo "<th>Number_of_Movies</th>";
        echo "<th>Average_Duration"; 
        echo "</tr>";
        
        foreach($record as $records) {
        echo "<tr>";
        echo "<td>" . $records['movie_category'] . "</td>";
        echo "<td>" . $records['number_of_movies'] . "</td>";
        echo "<td>" . $records['avg_duration'] . "</td>"; 
        echo "</tr>";
        }
        echo "</table>";
        

    }
    
    function longestMovie(){
        global $conn;
        
        $sql = "SELECT movie_title, movie_category, duration, company, release_year
                FROM movie 
                WHERE release_year>2000
                ORDER BY duration DESC
                LIMIT 3";
        
        $statement= $conn->prepare($sql); 
        $statement->execute();
        $record = $statement->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Movie_Category</th>";
        echo "<th>Duration</th>";  
        echo "<th>Company</th>"; 
        echo "<th>Release_year</th>"; 
        echo "</tr>";
        
        foreach($record as $records) {
        echo "<tr>";
        echo "<td>" . $records['movie_title'] . "</td>";
        echo "<td>" . $records['movie_category'] . "</td>";
        echo "<td>" . $records['duration'] . "</td>";
        echo "<td>" . $records['company'] . "</td>";
        echo "<td>" . $records['release_year'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";
    }
    
    function winnerLess(){
        global $conn;
        
        $sql = "SELECT firstName, lastName
                FROM celebrity c LEFT JOIN oscar o
                on c.celebrityId = o.celebrityId
                WHERE o.celebrityId IS NULL
                ORDER BY c.lastName";
        
        $statement= $conn->prepare($sql); 
        $statement->execute();
        $record = $statement->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "</tr>";
        
        foreach($record as $records) {
        echo "<tr>";
        echo "<td>" . $records['c.firstName'] . "</td>";
        echo "<td>" . $records['c.lastName'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/styles2.css" type="text/css"/>
        <title>CST 336 Midterm - Program 2</title>
        
        <table border="1" width="600">
            <tbody><tr><th>#</th><th>Task Description</th><th>Points</th></tr>
                <tr style="color:#006000">
                    <td>1</td>
                    <td>Name and country of birth of female actresses who were NOT born in the USA, ordered by last name</td>
                    <td width="20" align="center">10</td>
                </tr>  
                <tr style="color:#006000">
                    <td>2</td>
                    <td>Number of movies per category and their average duration</td>
                    <td width="20" align="center">10</td>
                    </tr>  
                <tr style="color:#006000">
                    <td>3</td>
                    <td>All info about the top three longest movies released after 2000</td>
                    <td width="20" align="center">15</td>
                </tr>     
                <tr style="color:#600000">
                    <td>4</td>
                    <td>List of  actors and actresses who have not won an academy award, ordered by last name </td>
                    <td align="center">15</td>
                </tr>
                <tr style="color:#600000">
                    <td>5</td>
                    <td>List of celebrities who have won an oscar, ordered by "award_year". Include full name, movie title, oscar year, and award category.</td>
                    <td width="20" align="center">15</td>
                </tr>     
                <tr style="color:#006000">
                    <td>6</td>
                    <td>This rubric is properly included AND UPDATED (BONUS)</td>
                    <td width="20" align="center">2</td>
                </tr>     
                <tr>
                    <td></td>
                    <td>T O T A L </td>
                    <td width="20" align="center"><b></b></td>
                </tr> 
            </tbody>
        </table>    
        <br>
    </head>
    <main>
        <body>
            <h1>Non-USA Actresses</h1>
            <?=notFromUSA()?>
            
            <h1>Category and Average Duration</h1>
            <?=movieAvgDuration()?>
            
            <h1>Longest Movies after 2000 </h1>
            <?=longestMovie()?>
            
            <h1>Actors and actresses who have not won an academy award</h1>
            <?=winnerLess()?>
            
        </body>
    </main>

</html>