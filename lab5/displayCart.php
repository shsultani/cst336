<!DOCTYPE html>
<html>
    <head>
        <title> Lab 5: TC: Device Search </title>
    
        <link rel="stylesheet" href="../lab5/css/styles.css" type="text/css" />
    </head>
    <body class="wrapper">
        <main>
            <br />
            
            <form>
            
                <?php
                    session_start();
                    
                    if (!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = array();  //initializing session variable
                    }
                    
                    $cart = $_GET['cart'];
                    
                    foreach($cart as $element){   
                        if (!in_array($element, $_SESSION['cart'])) { //avoid duplicate device Ids
                           $_SESSION['cart'][] = $element;
                        }
                    }
                    
                    echo "<font color=red><strong><br/><br/> Devices to reserve: <br /><br /></strong></font>";
                    
                    foreach($_SESSION['cart'] as $element ) {
                        echo "<strong>" . $element . "</strong><br/>";
                    }
                ?>
            
                <br><br>
                <input class='button' type="submit" value="Reserve" />
                <input class='button' type="button" value="Back" onClick="history.go(-1);return true;">
                <br><br>
            </form>
            
            <br><br><br><br>
            <br />
        </main>
        <hr>
        <footer>&copy; Sultani, 2017. <br/> Disclaimer: The information on this page might not be accurate. It's used for academic purposes. <br/><br>
            <img src="../../img/csumb-logo.png" alt="CSUMB Logo" />
        </footer>
    </body>
</html>