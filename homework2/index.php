<!DOCTYPE html>
<html lang="en">

<head>
    <title>Shaikh Sultani Homework 2</title>
    <link rel="stylesheet" href="../homework2/css/styles.css" type="text/css" />
</head>

<body>
    <main>
        <br>
          <h1>Welcome to the Lottery</h1>
        <figure>
            <img src="img/lottery.jpeg" class="wrap1" alt="Lottery" />
            <img src="img/balls.jpg" class="wrap2" alt="Lottery" />
        </figure>

        <br><br>

        <span class="title"> These are your lucky numbers</span>
        <br><br><br>

        <div class="lotterytable">

            <table border='0'>
                <tr>
                    <?php
                        $numbers = array();
                        $redball = array();
                                         
                        for($i = 0; $i < 5;) {
                            $randnum = rand (1, 69);
 
                            if(!in_array( $randnum, $numbers) )  :
                                $numbers[$i] = $randnum;
                                $i++;
                            endif;
                        }
                         
                        
                         for($j = 0; $j < 1;) {
                            $ram = rand (1, 26);
                             
                            if(!in_array( $ram, $redball) )  :
                                $redball[$j] = $ram;
                                $j++;
                            endif;
                        }
                             
                        sort($numbers);
                         
                    
                        for($i = 0; $i < 5; $i++) {
                            if($numbers[$i] == 0){
                                echo("<td> Error! </td>");} 
                            elseif($numbers[$i] <= 10){
                                echo("<td>" . rsort($numbers) . "</td>");
                                }else 
                                echo("<td>" . $numbers[$i] . "</td>");
                        }

                        for($j = 0; $j < 1; $j++) {
                            if($redball[$j] == 0)
                                echo("<td style='background-color:#FF0000'> Error! </td>"); 
                            else
                                echo("<td style='background-color:#FF0000'>" . $redball[$j] . "</td>");
                        }
                    ?>
                </tr>
            </table>
        </div>
        <br><br><br>
    </main>
    
    <br><br>
    <hr>
    
    <div class="wrap">
        <h2><a class="reload" href="https://cst336-hsultani.c9users.io/cst336-github/homework2/index.php">Try Again</a>
    </div>
    <br><br>
    <hr1>
        
    <footer>&copy; Sultani, 2017. <br/> Disclaimer: The information on this page might not be accurate. It's used for academic purposes. <br/>
        <img src="img/csumb-logo.png" alt="CSUMB Logo" />
    </footer>
</body>

</html>