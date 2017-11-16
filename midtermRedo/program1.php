<?php
    session_start();
    $_SESSION["even"]; 
    $_SESSION["odd"]; 
?>
<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="css/styles1.css" type="text/css"/>
    <title>CST 336 Midterm - Program 1</title>
    
    
    <table border="1" width="600">
    <tbody><tr><th>#</th><th>Task Description</th><th>Points</th></tr>
    <tr style="color:#008000">
      <td>1</td>
      <td>The page includes the basic form elements as in the Program Sample: Text boxes, Checkbox, radio buttons</td>
      <td width="20" align="center">3</td>
    </tr>
    <tr style="color:#008000">
      <td>2</td>
      <td>When accessing the webpage directly, a 3x3 table with random balls is displayed</td>
      <td width="20" align="center">10</td>
    </tr> 
    <tr style="color:#008000">
      <td>3</td>
      <td>The balls are NOT duplicated </td>
      <td align="center">5</td>
    </tr>    
	<tr style="color:#008000">
      <td>4</td>
      <td>Even balls have a yellow background. The cue ball (the white ball) is even </td>
      <td align="center">5</td>
    </tr> 
    <tr style="color:#008000">
      <td>5</td>
      <td>Odd balls have a green background</td>
      <td align="center">5</td>
    </tr>
    <tr style="color:#008000">
      <td>6</td>
      <td>The sum of ball values is displayed below the table</td>
      <td align="center">5</td>
    </tr>       
    <tr style="color:#008000">
      <td>7</td>
      <td>When submitting the form, a table with random balls is created using the custom number of rows and columns</td>
      <td align="center">10</td>
    </tr>  
    <tr style="color:#008000">
      <td>8</td>
      <td>There is validation for empty number of rows and columns, and rows and columns greater than 4  </td>
      <td align="center">5</td>
    </tr>  
    <tr style="color:#008000">
      <td>9</td>
      <td>When the  "Include the 8 ball" checkbox is checked, the 8 ball must be displayed within the table, in a random position </td>
      <td align="center">5</td>
    </tr>    
    <tr style="color:#008000">
      <td>10</td>
      <td>The balls are displayed in ascending order if "Ascending" is checked. </td>
      <td align="center">5</td>
    </tr>        
    <tr style="color:#008000">
      <td>11</td>
      <td>The balls are displayed in descending order if "Descending" is checked. </td>
      <td align="center">5</td>
    </tr> 
    <tr style="color:#008000">
      <td>12</td>
      <td>The total number of points of even and odd balls is properly displayed. </td>
      <td align="center">5</td>
    </tr>  
    <tr style="color:#008000">
      <td>13</td>
      <td>The right winner (even balls, odd balls, or tie) is displayed. </td>
      <td align="center">5</td>
    </tr>              
    <tr style="color:orange">
      <td>14</td>
      <td>This rubric is properly included AND UPDATED (BONUS)</td>
      <td width="20" align="center">2</td>
    </tr>     
     <tr>
      <td></td>
      <td>T O T A L </td>
      <td width="20" align="center"><b></b></td>
    </tr> 
  </tbody></table>
  <br>
</head>
<main>
    <body>
        <br>
        <?php
            $arr = array(); 
            $balls = 9; 
            $rows = 3;
            $start = 0;
            $totalEven = 0; 
            $totalOdd = 0; 
            
            if(isset($_GET['rows'])){
                $balls = $_GET['rows'] * $_GET['cols'];
                $rows = $_GET['rows'];
                if(isset($_GET['8ball'])){
                    $arr[0] = 8;
                    $start = 1; 
                }
                for($i = $start; $i < $balls; $i++){
                    $number = rand(0,15);
                    while(in_array($number, $arr)){
                        $number = rand(0,15); 
                    }
                    $arr[$i] = $number;
                }
            }
            else {
                for($i = 0; $i < 9; $i++){
                    $number = rand(0,15);
                    while(in_array($number, $arr)){
                        $number = rand(0, 15); 
                    }
                    $arr[$i] = $number; 
                }
            }
            
            if(isset($_GET['order'])){
                if($_GET['order']=='asc'){
                    sort($arr);
                }
                if($_GET['order']=='desc'){
                    rsort($arr);
                }
            }
            
            echo "<div class = 'wrapper'><br>";
            echo "<div class = 'result'><h1>Billiards: Even or Odd!</h1></div>";
            echo "<div class = 'row'>"; 
            
            for($i = 0; $i < $balls; $i++){
                if($i % $rows == 0){
                    echo "</div><div class = 'row'>";
                }
                echo "<div class = 'cell' "; 
                if($arr[$i] % 2 == 0){
                    echo "style='background-color:yellow'>";
                    $totalEven += $arr[$i]; 
                }
                else{
                    echo "style='background-color:green'>";
                    $totalOdd += $arr[$i]; 
                }
                echo "<img src = 'billiards/$arr[$i].png' width='100%'></div>";
            }
            
            echo "</div><br>"; 
            echo "<div class ='result'><br><br>" ;
            echo "<br>";
            if($totalEven > $totalOdd){
                echo "<br>Even Balls: $totalEven Odd Balls: $totalOdd <br>";
                echo "Even balls wins!";
                $_SESSION['even']++;
            }
            if($totalOdd > $totalEven){
                echo "<br>Even Balls: $totalEven Odd Balls: $totalOdd <br>";
                echo "Odd balls wins! "; 
                $_SESSION['odd']++;
            }
            echo "<br>";
            echo "Total Points: " . array_sum($arr);
        ?>
        <br><br>
        <hr>
        <h2>Customize Output</h2>
        <form>
            Rows: <input type="number" name="rows" max="4" min="0" required/>
            Columns: <input type="number" name="cols" max="4" min="0" required/>
            (Values must not exceed 4)
            <br><br>
            <input type="checkbox" name="8ball" />Include 8 Balls <br><br>
            Order Balls:
            <input type="radio" name="order" value="asc"/>Order by Ascending 
            <input type="radio" name="order" value="dsc"/>Order by Descending <br><br>
            <input type="submit" name="submit" value="submit"/>
        </form>
    </body>
</main>

</html>