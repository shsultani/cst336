    <table border="1" width="600">
    <tbody><tr><th>#</th><th>Task Description</th><th>Points</th></tr>
    <tr style="background-color:#99E999">
      <td>1</td>
      <td>The page includes the form elements as the Program Sample: dropdown menu, radio buttons, etc.</td>
      <td width="20" align="center">3</td>
    </tr>
    <tr style="background-color:#99E999">
      <td>2</td>
      <td>Errors are displayed if month or number of locations are not submitted.</td>
      <td width="20" align="center">5</td>
    </tr> 
    <tr style="background-color:#99E999">
      <td>3</td>
      <td>Header and Subheader are displayed with info submitted. </td>
      <td align="center">5</td>
    </tr>    
    <tr style="background-color:#99E999">
      <td>4</td>
      <td>A table with days and weeks is created when submitting the form</td>
      <td align="center">10</td>
    </tr> 
    <tr style="background-color:#99E999">
      <td>5</td>
      <td>The number of days in the table correspond to the month selected</td>
      <td align="center">10</td>
    </tr>
    <tr style="background-color:#FFC0C0">
      <td>6</td>
      <td>Random images are displayed in random days</td>
      <td align="center">5</td>
    </tr>       
    <tr style="background-color:#FFC0C0">
      <td>7</td>
      <td>The number of random images correspond to the number of locations and country submitted</td>
      <td align="center">10</td>
    </tr>  
    <tr style="background-color:#FFC0C0">
      <td>8</td>
      <td>The proper name of the location is displayed below the image (e.g. "New York", "Las Vegas") </td>
      <td align="center">10</td>
    </tr>  
    <tr style="background-color:#FFC0C0">
      <td>9</td>
      <td>Random locations should be ordered alphabetically, if user checks corresponding radio button (A-Z or Z-A). </td>
      <td align="center">15</td>
    </tr>        
    <tr style="background-color:#FFC0C0">
      <td>10</td>
      <td>The web page uses Bootstrap and has a nice look. </td>
      <td align="center">5</td>
    </tr>        
    <tr style="background-color:#99E999">
      <td>11</td>
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
$number = range(1,31);

function displayTable() {
    if (isset($_GET['submit'])) {
		$month = $_GET['month'];
		$locationsNumber= $_GET['locationsNumber'];
		$country= $_GET['country'];
		$order= $_GET['order'];
    
    	if (empty($_GET['month'])) {
    		echo "<h2 style='color:red'><strong>You must select a Month! </strong></h2>";
    		return;
        }
    	
    	if(!isset($_GET['locationsNumber'])){
    	    echo "<h2 style='color:red'><strong>You must specify the number of locations! </strong></h2>";
    	    return;
    	}
		
		echo "<hr><h3>" . $month . " Itinerary" ."</h3>";
		echo "<h4> Visiting ". $locationsNumber . " places in " . $country . "</h4>";
        
        // $numberTable = getNumberTable($month, $locationsNumber);
 		echo "<table border='1'  style='margin:0' cellpadding=60>";
 	 	$index = 1;
 	 	if($month == "November" )
 	 	{
 	 	    
 	 	    $indexm = 31;    
 	 	}
 	 	
 	 	if($month == "January" || $month == "December")
 	 	{
 	 	    
 	 	    $indexm = 32;    
 	 	}
 	 	if($month == "February")
 	 	{
 	 	    
 	 	    $indexm = 29;    
 	 	}
 	 	
		for ($rows = 0; $rows < 5; $rows++) {
			echo "<tr>";
			for ($cols = 0; $cols < 7; $cols++) {
			 //  $letterToDisplay = $numberTable[$index];
                if($index < $indexm)
				    {
				        echo "<td>" . $index . "</td>";
				        $index++;
				    }
				    else
				    break;
			}
			echo "</tr>";
		}
		echo "</table>";
	}	
}

function imageDisplay(){
	$month = $_GET['month'];
	$locationsNumber= $_GET['locationsNumber'];
	$country= $_GET['country'];
	$order= $_GET['order'];
	
	if($country == 'USA'){
	    $USArray = array("../img/USA/chicago.png", "../img/USA/hollywood.png", "../img/USA/las_vegas.png", "../img/USA/ny.png", "../img/USA/washington_dc.png", "../img/USA/yosemite.png"); 
	}
	if($country == 'Mexico'){
	    $mexicoArray = array("../img/Mexico/acapulco.png", "../img/Mexico/cabos.png", "../img/Mexico/cancun.png", "../img/Mexico/chizhenitza.png", "../img/Mexico/huatelco.png", "../img/Mexico/mexico_city.png");
	}
	if($country == 'Norway'){
	    $norwayrray = array("../img/Norway/alesund.png", "../img/hollywood.png", "../img/las_vegas.png", "../img/ny.png", "../img/washington_dc.png", "../img/yosemite.png");
	}
	
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Winter Vacation Planner</title>
    <link rel="stylesheet" href="css/styles.css" type="text/css"/>
    
</head>
<body>
  
    <div class="jumbotron">
    <h1> Winter Vacation Planner</h1>
    </div>
    
    <div id="wrapper">
    <form method='get'>
    	Select Month:
    	<select name="month">
    	<option value="">Select</option>
    	<option value="November">November</option>
        <option value="December">December</option>
        <option value="January">January</option>
        <option value="February">February</option>
    	</select>
    	<br /><br />
    	
    	Number of locations:
    	<input id="3" type="radio" name="locationsNumber" value="3">
        <label for="locationsNumber"><strong>Three</strong></label>
        <input id="4" type="radio" name="locationsNumber" value="4">
        <label for="locationsNumber"><strong>Four</strong></label>
        <input id="5" type="radio" name="locationsNumber" value="5">
        <label for="locationsNumber"><strong>Five</strong></label>
    	<br /><br />
    	
    	Select Country:
    	<select name="country">
    	<option value="USA">USA</option>
        <option value="Mexico">Mexico</option>
        <option value="Norway">Norway</option>
    	</select>
    	<br /><br />
    	
    	Visit locations in alphabetical order:
    	<input id="asc" type="radio" name="order" value="asc">
        <label for="locationsNumber"><strong>A-Z</strong></label>
        <input id="desc" type="radio" name="order" value="desc">
        <label for="locationsNumber"><strong>Z-A</strong></label>
    	<br /><br />
    	
    	<input type="submit" value="Create Itinerary" name="submit" />
    </form>
    
    <?=displayTable() ?>
    
    </div>
</body>
</html>
