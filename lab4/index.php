<!DOCTYPE html>
<html>
    <?php
        $backgroundImage = "img/sea.jpg";
        
        // API call goes here 
        if(isset($_GET['keyword'])) {
          include 'api/pixabayAPI.php'; 
          $imageURLs = getImageURLs($_GET['keyword'. layout]);
          $backgroundImage = $imageURLs[array_rand($imageURLs)]; 
        }
    ?>
    
    <head>
        <title>Image Carousel</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style>
            @import url("css/styles.css"); 
            body {
                background-image: url('<?=$backgroundImage ?>');
                background-size: 100%, 100%;
                background-attachment: fixed;
            }
        </style>
    </head>
    
    <body>
        <br/><br/>
        <!-- HTML form goes here! --> 
        <form>
          <input type="text" name="keyword" placehoder="Keyword">
          
          <div id="layoutRadio">
            <input type="radio" name="layout" value="Horizontal" id="layout_h"/>
            <label for="layout_h">Horizontal</label>
            <br/>
            <input type="radio" name="layout" value="Vertival" id="layout_v"/>
            <label for="layout_v">Vertival</label>
          </div>
          
          <select name="keyword" style="color:black; font-size:1.5em">
           <option value=""> - Select One - </option>
           <option value="ocean"  > Sea </option>
           <option> Mountains </option>
           <option> Forest </option>
           <option> Sky </option>
           <option> Otter </option>
          </select><br /><br />
          
          <input type="submit" value="Submit" name="submit"/>
        </form>
        
        <br/><br/>
        
        <?php
          if(!isset($imageURLs)){
            echo "<h2> Type a keyword to display a slideshow <br/> with random images from Pixabay.com </h2>"; 
          } else {
          //Display Carousel here
        ?>

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              <!-- Indicators Here -->
            <ol class="carousel-indicators">
              <?php
                for($i = 0; $i < 7; $i++){
                  echo "<li data-target='#carousel-example-generic' data-slide-to=' $i '";
                  echo ($i == 0)?" class='active'": ""; 
                  echo "></li>"; 
                }
              ?>
            </ol>
          
            <!-- Wrapper for Images --> 
            <div class="carousel-inner" role"listbox">
              <?php
                for($i = 0; $i < 7; $i++){
                  do {
                    $randomIndex = rand(0, count($imageURLs)); 
                  }
                  while (!isset($imageURLs[$randomIndex]));

                  echo '<div class="item '; 
                  echo ($i == 0)?"active" : ""; 
                  echo '">'; 
                  echo '<img src="' . $imageURLs[$randomIndex] . '">'; 
                  echo '</div>'; 
                  unset($imageURLs[$randomIndex]);
                }
              ?>
            </div>
        
            <!-- Controls Here -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
        
        <?php
          }
        //end of else statement 
        ?>
      
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <br/><br/>
    </body>
</html>