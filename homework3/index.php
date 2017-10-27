<?php
    
    if(isset($_GET['first'])){
        
        if(($_GET['first']!="") && ($_GET['second']!="") && ($_GET['operation']!="")){
        	$first = $_GET['first'];
	        $second = $_GET['second'];
	        $result = "";
	        
	        if ($_GET['operation'] == '+')
	        {
	            $num1 = $first;
	            $num2 = $second;
	            $result = $num1 + $num2;
	            
	        }
	        
	        else if ($_GET['operation'] == '-')
	        {
	            $num1 = $first;
	            $num2 = $second;
	            $result = $num1 - $num2;
	            
	        }
	        
	        else if ($_GET['operation'] == '*')
	        {
	            $num1 = $first;
	            $num2 = $second;
	            $result = $num1 * $num2;
	           
	        }
	        
	        else if ($_GET['operation'] == '/')
	        {
	            $num1 = $first;
	            $num2 = $second;
	            if($num2!=0){
	                $result = $num1 / $num2;
	            }
	            else{
	                $result="Error cannot div by 0";
	            }
	            
	        }
	        
	         else if ($_GET['operation'] == 'pow')
	        {
	            $num1 = $first;
	            $num2 = $second;
	            $result = pow($num1,$num2);
	           
	        }
	       
	        else if ($_GET['operation'] == 'log')
	        {
	            $num1 = $first;
	            $num2 = $second;
	            $result = log($num1,$num2);//First you are entering the number then the base of log.
	           
	        }
	        
        }
        else{
        	$result="Please input values";
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Homework 3: Calculator</title>

<link rel="stylesheet" href="css/styles.css" type="text/css" />
</head>
<body class="wrapper">
    <main>

        <h1>Simple Calculator</h1>
        <form method="GET">
        
        <table>
          <tr>
            <td>Enter First Value </td>
            <td><input type="text" name="first" placeholder="Type a number"></td>
          </tr>
          <tr>
            <td colspan="2"><font color="red">
             <input type="radio" name="operation" value="+" id="+" /><label for="+"> + </label> 
             <input type="radio" name="operation" value="-" id="-" /><label for="-"> - </label> 
             <input type="radio" name="operation" value="*" id="*" /><label for="*"> * </label> 
             <input type="radio" name="operation" value="/" id="/" /><label for="/"> / </label><br><br>
             <input type="checkbox" name="operation" value="pow" id="Pow" /><label for="Pow"> Pow </label>
             <input type="checkbox" name="operation" value="log" id="Log" /><label for="Log"> Log </label>  
            </td></font>
          </tr>
          <tr>
            <td>Enter Second Value </td>
            <td><input type="text" name="second" placeholder="Type a number"></td>
          </tr>
          <tr>
            <td><br>Result </td>
            <td><br>
             <?php
            if(isset($_GET['first'])){
                echo "<font color='red'> $result </font>";
            }
            ?>
            </td>
          </tr>
          <tr>
            <td><br><br><input class="button" type="submit" name="calcbutton" value="Calculate"></td>
            <td><br><br><input class="button" type="reset" name="resetbutton" value=" Reset " ></td>
          </tr>
         
        </table>
        </form>
    </main>
      <hr>
    <footer>&copy; Sultani, 2017. <br/> Disclaimer: The information on this page might not be accurate. It's used for academic purposes. <br/>
            <img src="img/csumb-logo.png" alt="CSUMB Logo" />
    </footer>
  </body>
 </html>
</body>
</html>