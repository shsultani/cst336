<script>
    
    
    if(document.getElementById("first") != null){
        
        if((document.getElementById("first")!="") && (document.getElementById("second")!="") && (document.getElementById("operation")!="")){
        	var first = document.getElementById("first");
	        var second = document.getElementById("second");
	        var result = "";
	        
	        if (document.getElementById("operation") == '+'){
	            var num1 = first;
	            var num2 = second;
	            result = num1 + num2;
	        }
	        else if (document.getElementById("operation") == '-'){
	            num1 = first;
	            num2 = second;
	            result = num1 - num2;
	        }
	        else if (document.getElementById("operation") == '*'){
	            num1 = first;
	            num2 = second;
	            result = num1 * num2;
	        }
	        else if (document.getElementById("operation") == '/'){
	            num1 = first;
	            num2 = second;
	            if(num2!=0){
	                result = num1 / num2;
	            }
	            else{
	                result="Error cannot div by 0";
	            }
	        }
	         else if (document.getElementById("operation") == 'pow'){
	            num1 = first;
	            num2 = second;
	            result = Math.pow(num1,num2);
	           
	        }
	        else if (document.getElementById("operation") == 'log'){
	            num1 = first;
	            num2 = second;
	            result = Math.log(num1,num2);
	        }
        }
        else{
        	result="Please input values";
        }
    }
</script>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Homework 4: Calculator in Javascript</title>

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
             <script>
                 if(document.getElementById('first') != null ){
                    print result;
                }
             </script>
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