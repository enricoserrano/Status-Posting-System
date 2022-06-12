<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel = "stylesheet" type = "text/css" href = "styles.css"/>
      <title>Search Status Process</title>
   </head>
   <body>
      <div class="box-container">
         <h1>Displaying Results</h1>
         <?php
            require_once('../../conf/connectionInfo.php');
            
            $statussearch = $_GET['search'];
            
            if(empty($_GET['search'])) {
                echo "<p>Seach string can't be empty, please enter a keyword to search</p>";
            } else {
            
            $establishCon = mysqli_connect($hostName, $userName, $password, $dbName);
            
            if(!$establishCon) {
                echo "<p>Failed to establish connection!</p>";
            } else {
                $checkStatus = mysqli_query($establishCon, "SELECT * from `statusTable` where `bookingTable` LIKE '%$statussearch%'");

                if (mysqli_num_rows($checkStatus) > 0) {
                    while ($row = mysqli_fetch_assoc($checkStatus)){               
                        echo "<b>Status: </b>", $row["statuscode"], "<br>";
                        echo "<b>Status Code: </b>", $row["status"], "<br><br>";
                        echo "<b>Share: </b>", $row["share"], "<br>";
                        echo "<b>Date Posted: </b>", date('F j, Y', strtotime($row["datePosted"])), "<br>";
                            if (empty($row["permission"])) {
                            echo "<b>Permission: </b> No Permission Selected", "<br>";
                            } else {
                            echo "<b>Permission: </b>", $row["permission"], "<br>";
                            }
                            echo "__________________________________", "<br><br>";
                    }
                mysqli_free_result($checkStatus);
                } else {
                    echo "<p>The status you entered does not exist</p>";
                }
                } 
            }
            mysqli_close($establishCon);
            ?>
         <br>
         <a href="http://cqp5107.cmslamp14.aut.ac.nz/assign1/searchstatusform.html" class="indexsearch-button">Search another status</a>
         <a href="http://cqp5107.cmslamp14.aut.ac.nz/assign1/poststatusform.php" class="indexpost-button">Post a new status</a>
         <a href="http://cqp5107.cmslamp14.aut.ac.nz/assign1/index.html" class="back-button">Back To Homepage</a>
      </div>
   </body>
</html>