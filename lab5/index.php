<?php

function getDatabaseConnection($dbname){
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $username = "b5e6d1a0e56ec3";
    $password = "275bf378";
    
    //Creates a database connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Setting Errorhandling to Exception
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    return $dbConn;    
}

$dbConn = getDatabaseConnection('heroku_13c04fde7f2eac6');

function getDeviceTypes(){
    global $dbConn;
    $sql = "SELECT DISTINCT(deviceType) 
            FROM device 
            ORDER BY deviceType" ;
            
      $statement= $dbConn->prepare($sql); 
      $statement->execute();
      $records = $statement->fetchALL(PDO::FETCH_ASSOC);  
      
      //print_r($records);
      
      foreach($records as $record) {
          echo "<option value='" . $record['deviceType'] . "'>" . $record['deviceType'] . "</option>";
      }
            
            
}

function displayDevices() {
    global $dbConn;
    $sql = "SELECT * 
            FROM device 
            WHERE 1 " ;  //Getting all records 
            
            if (isset($_GET['submit'])){
            //form has been submitted

                $namedParameters = array();
                
                
                if (!empty($_GET['deviceName'])){
                    //deviceName has some value
                    
                    // Following sql works but it doesn't prevent SQL INJECTION
                   //  $sql = $sql . " AND deviceName LIKE  '%" . $_GET['deviceName'] . "%'";
                   $sql = $sql . " AND deviceName LIKE  :deviceName "; //using Named Parameters to prevent SQL Injection
                   
                   $namedParameters[':deviceName'] = "%" . $_GET['deviceName'] . "%";
                   
                }
                
                if(!empty($_GET['deviceType'])){
                    //type has been selected
                    
                    $sql = $sql . " AND deviceType = :deviceType";
                    
                    $namedParameters[':deviceType'] = $_GET['deviceType'];
                }
                
                if(isset($_GET['available'])){
                    $sql = $sql . " AND status = :status";
                    $namedParameters[':status'] = "available";
                }
                
            
            }
            
                if (isset($_GET['sortbyN'])) {
 
                   $sortbyN = $_GET['sortbyN'];
 
             
                if ($sortbyN = 'priceh') {
  
                   $sql = $sql .  " ORDER BY price DESC";
                 }
                }
                
                if (isset($_GET['sortby'])) {
 
                   $sortby = $_GET['sortby'];
  
                if ($sortby = 'name') {
  
                   $sql = $sql .  " ORDER BY deviceName";
                }
                }

            
      $statement= $dbConn->prepare($sql); 
      $statement->execute($namedParameters); //Always pass the named parameters, if any
      $records = $statement->fetchALL(PDO::FETCH_ASSOC);  
      
      //print_r($records);
      echo "<table>";
      foreach($records as $record) {
          echo "<tr><td><input type='checkbox' name='cart[]'  value =" . $record['deviceId'] . "></td> ";
          echo "<td>" . $record['deviceName'] . " - ". $record['deviceType'] .  " - ". $record['status'] . "</tr>";
      }

      echo "</table>";
     
  
   
}



?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 5: Device Search </title>
        <link rel="stylesheet" href="../lab5/css/styles.css" type="text/css" />
    </head>
    <body>
        <main>
             <h1> Technology Center: Checkout System </h1>
             
             <form>
                Device:
                <input Type="text" name ="deviceName" placeholder ="Device Name">
                &nbsp; Type: 
                <select name="deviceType" >
                    <option value = "">Select One</option>
                    <?=getDeviceTypes()?>
                </select>
                &nbsp; <input type= "checkbox" name= "available" id ="available" value="available" />
                 <label for="available" > Available</label><br><br>
                 <input type="checkbox" name="sortbyN" id ="sortbyN" value ="sortbyN"/>
                 <label for="sortbyN"> Order by Price </label>
                 &nbsp;&nbsp;&nbsp;<input type="checkbox" name="sortby" id ="sortby" value ="sortby"/>
                 <label for="sortby"> Order by Name </label>
                &nbsp;&nbsp; <input class='button' type="submit" name ="submit" value="Search"/>
             </form>
    
             <br/><br/>
             
            <form action="displayCart.php">
                <br>
                    <?=displayDevices()?>
                <br/>
                <input  class='button' type="submit" value="Continue">
            </form>  
             
            <br><br><br><br>
            <br />
        </main>
        <hr>
        <footer>&copy; Sultani, 2017. <br/> Disclaimer: The information on this page might not be accurate. It's used for academic purposes. <br/><br>
            <img src="../lab5/img/csumb-logo.png" alt="CSUMB Logo" />
        </footer>
    </body>
</html>