        <table border="1" width="600">
        <tbody><tr><th>#</th><th>Task Description</th><th>Points</th></tr>
        <tr style="background-color:#99E999">
          <td>1</td>
          <td>A report shows all female students ordered by last name, from A to Z</td>
          <td width="20" align="center">10</td>
        </tr>  
        <tr style="background-color:#99E999">
          <td>2</td>
          <td>A report shows students  that have  assignments with a grade lower than 50, ordered by grade, in ascending order</td>
          <td width="20" align="center">10</td>
        </tr>  
        <tr style="background-color:#99E999">
          <td>3</td>
          <td>A report lists those assignments that have not been graded and their due date, ordered by due date, ascending</td>
          <td width="20" align="center">15</td>
        </tr>     
         <tr style="background-color:#99E999">
           <td>4</td>
           <td>A report shows the Gradebook, which includes first name, last name, assignment title, and grade. It should be ordered by last name and assignment title </td>
           <td align="center">15</td>
         </tr>
         <tr style="background-color:#99E999">
          <td>5</td>
          <td>A report lists each student along with his/her average grade, ordered by average grade, from highest to lowest</td>
          <td width="20" align="center">15</td>
        </tr>     
         <tr style="background-color:#99E999">
          <td>6</td>
          <td>This rubric is properly included AND UPDATED (BONUS)</td>
          <td width="20" align="center">2</td>
        </tr>     
         <tr>
          <td></td>
          <td>T O T A L </td>
          <td width="20" align="center"><b></b></td>
        </tr> 
        </tbody></table>  

<?php
    include 'database.php';
    $conn = getDatabaseConnection();

    function allFemaleStudents(){
        global $conn;
        
        $sql = "SELECT firstName, lastName 
                FROM `m_students` 
                WHERE gender='F' 
                ORDER BY lastName ASC";
                
        $stm = $conn->prepare($sql); 
        $stm->execute();
        $record = $stm->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr>";
        echo "<th>firstName</th>";
        echo "<th>lastName</th>";
        echo "</tr>";
        
        foreach($record as $records) {
        echo "<tr>";
        echo "<td>" . $records['firstName'] . "</td>";
        echo "<td>" . $records['lastName'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";
    }
    
    function lowerThanFifty(){
                global $conn;
        
        $sql = "SELECT firstName , lastName, grade 
                FROM m_students 
                NATURAL JOIN m_gradebook 
                WHERE grade <50 
                ORDER BY grade ASC";
                
        $stm = $conn->prepare($sql); 
        $stm->execute();
        $record = $stm->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr>";
        echo "<th>firstName</th>";
        echo "<th>lastName</th>";
        echo "<th>grade</th>";
        echo "</tr>";
        
        foreach($record as $records) {
        echo "<tr>";
        echo "<td>" . $records['firstName'] . "</td>";
        echo "<td>" . $records['lastName'] . "</td>";
        echo "<td>" . $records['grade'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";
    }
    
    function ungraded(){
        global $conn;
        
        $sql = "SELECT title, dueDate 
                FROM m_assignments x 
                LEFT JOIN m_gradebook y 
                ON x.assignmentId = y.assignmentId 
                WHERE y.assignmentId IS NULL";
                
        $stm = $conn->prepare($sql); 
        $stm->execute();
        $record = $stm->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr>";
        echo "<th>title</th>";
        echo "<th>dueDate</th>";
        echo "</tr>";
        
        foreach($record as $records) {
        echo "<tr>";
        echo "<td>" . $records['title'] . "</td>";
        echo "<td>" . $records['dueDate'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";
    }
    
    function gradeBook(){
        global $conn;
        
        $sql = "SELECT firstName , lastName, title , grade 
                FROM m_students 
                NATURAL JOIN m_gradebook 
                NATURAL JOIN m_assignments 
                ORDER By lastName , title";
                
        $stm = $conn->prepare($sql); 
        $stm->execute();
        $record = $stm->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr>";
        echo "<th>firstName</th>";
        echo "<th>lastName</th>";
        echo "<th>title</th>";
        echo "<th>grade</th>";
        echo "</tr>";
        
        foreach($record as $records) {
        echo "<tr>";
        echo "<td>" . $records['firstName'] . "</td>";
        echo "<td>" . $records['lastName'] . "</td>";
        echo "<td>" . $records['title'] . "</td>";
        echo "<td>" . $records['grade'] . "</td>";
        echo "</tr>";
        }
        echo "</table>";
    }
    
    function avgGrade(){
        global $conn;
        
        $sql = "SELECT x.studentId, x.firstName, x.lastName, AVG(y.grade) average 
                FROM m_students x 
                JOIN m_gradebook y ON x.studentId = y.studentId 
                GROUP BY x.studentId 
                ORDER BY average DESC";
                
        $stm = $conn->prepare($sql); 
        $stm->execute();
        $record = $stm->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table>";
        echo "<tr>";
        echo "<th>studentId</th>";
        echo "<th>firstName</th>";
        echo "<th>lastName</th>";
        echo "<th>average</th>";
        echo "</tr>";
        
        foreach($record as $records) {
        echo "<tr>";
        echo "<td>" . $records['studentId'] . "</td>";
        echo "<td>" . $records['firstName'] . "</td>";
        echo "<td>" . $records['lastName'] . "</td>";
        echo "<td>" . $records['average'] . "</td>";
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
        <br>
    </head>
    <main>
        <body>
            <h3>a. All female students</h3>
            <?=allFemaleStudents()?>
            
            <h3>b. Grades lower than 50</h3>
            <?=lowerThanFifty()?>
            
            <h3>c. List of assignments that have not been graded</h3>
            <?=ungraded()?>
            
            <h3>d. Gradebook</h3>
            <?=gradeBook()?>
            
            <h3>e. Average Grade per Student</h3>
            <?=avgGrade()?>
            
        </body>
    </main>

</html>