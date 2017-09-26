<?php
$suits = array("clubs", "diamonds", "hearts", "spades");
$deck = array();
for($i = 1; $i < 52; $i++)
{
    $deck[] = $i;
}

$studcardval= array();
$studname = array(); 
$studpic = array(); 
$studhand = array(); 
$rep = array();
array_push($studname, "Luigi");
array_push($studname, "Alex");
array_push($studname, "Jack");
array_push($studname, "House");
array_push($studpic, "luigi");
array_push($studpic, "alex");
array_push($studpic, "jack");
array_push($studpic, "house");

function displresult() {
  
    global $studhand;
    global $deck;
    global $suits;
    array_push($studhand, getHand());
    array_push($studhand, getHand());
    array_push($studhand, getHand());
    array_push($studhand, getHand());
    displayHand();
    getWinner();
 
}
function getHand(){
    global $deck; 
    global $suits; 
    global $studcardval;
    global $rep;
    
    $isFound = FALSE;
   
    $usopt = array();
    $amount = 0;
    
    while($amount < 42){
        $random_card = rand(0, count($deck));
        $card_suit = $suits[floor($random_card/ 13)]; 
        $card_value = ($random_card % 13) + 1;
        
        for($i=0; $i < count($rep); $i++)
        {
            if($random_card == $rep[$i])
            {
                $isFound = TRUE;
                break;
            }
        }
        
        if($isFound == FALSE)
        {
            if($amount + $card_value <= 42){
            $amount = $amount + $card_value;
            unset($GLOBALS[$deck[$random_card]]);
            
            array_push($usopt, $card_suit . "/" .$card_value);
        }
        else{
            break;
        }
            
        }
        
        
    }
    
    array_push($studcardval, $amount); 
    return $usopt;
    
}
function getWinner() {
    
    global $studcardval;
    global $studname;
    global $studpic;
    
    $winners = array();
    $winval;
    $winname;
    $winpic;
    
    $temwin = $studcardval[0];
    $temwinpic = $studpic[0];
    $temp_winner_name = $studname[0];
    $totalSum = $studcardval[0];
    
    $max_value = max($studcardval);
    $name_position = 0;
    for($i = 0; $i < 4; $i++) 
    {
        $totalSum += $studcardval[$i];
        
        if( $max_value == $studcardval[$i]) 
        {                                           
           
            array_push($winners, $studpic[$i]);
        }
        
    }
    $winval = $temwin;
    $winpic = $temwinpic;
    
    
    $counter = 0;
    
    for($i = 0; $i < count($winners); $i++){
        $name = $winners[$i];
        $first_letter = substr($name, 0, 1);
        if($first_letter == "l"){
            $winname = "Luigi";
             $counter++;
        }
        elseif($first_letter == "a"){
            $winname = "Alex";
             $counter++;
        }
        elseif($first_letter == "j"){
            $winname = "Jack";
             $counter++;
        }
        elseif($first_letter == "h"){
            $winname = "House";
             $counter++;
        }
       
       
        if($counter > 1)
        {
            echo " and ";
        }
        echo "$winname";
        
    }
    if($counter > 1){
            echo " are the winners!  <br> They received $totalSum points";
        }
        else{
            echo " is the winner!  <br> They received $totalSum points";
        }
}
function displayHand()
{
    global $studpic;
    global $studhand;
    global $studcardval;
    
    $length;
    
    shuffle($studpic);
    
    
    echo "<table>";
    for($i=0; $i<count($studhand); $i++)
    {
        echo'<tr>';
        echo'<td>';
        echo"<img src=Img/" . $studpic[$i] . ".jpg>";
        echo'</td>';
        
        $length = $studhand[$i];
        
        for($j=0; $j<count($length); $j++)
        {
            echo'<td>';
            echo "<img src= Img/cards/" .$studhand[$i][$j] .".png>";
            echo'</td>';
        }
        echo'<td>';
        echo $studcardval[$i];
        echo '</td>';
        echo '</tr>';
        echo "<br/>";
    }
    echo"</table>";
    
}
?>

<!DOCTYPE HTML>
<html>
    <!--<head>-->

        <!--<link rel="stylesheet" href="../lab3/Css/Styles.css" type="text/css" /> -->
    <!--</head>-->
    <body>
        <main>
        <div id="wrapper">
            <h1>Silverjack</h1>
        </div>
              <center>
                      <?=displresult()?>
              </center>
        <br/>    
        </main>
        <form>
           <center> <button type="submit" onclick="<?php displresult() ?>"name="displresult" id="button">PlayAgain</button></center>
        </form>

    </body>

</html>                   
   
  