<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel = "stylesheet" type = "text/css" href = "styles.css"/>
      <title>Process Post Status Page</title>
   </head>
   <body>
      <div class="box-container">
         <h1>Process Validation</h1>
         <?php
            require_once('../../conf/connectionInfo.php');
            
            //Initialising all variables used in the post status form
            $statusCode = $_POST['statuscode'];
            $status = $_POST['status'];
            $share = $_POST['share'];
            $date = $_POST['date'];
            
            //Loop through the permissions array and add each permission to one string
            foreach($_POST['permission'] as $permissionSearch){
                    $allPermission .= " $permissionSearch";
            }
            
            //Establishes connection to database
            $establishCon = mysqli_connect($hostName, $userName, $password, $dbName);
            
            //Checks if connection is successful if not create an error message
            if(!$establishCon) {
                echo "<p>Failed to establish connection!</p>";
                echo "<p style='color:#b32d2d';>Process Failed</p>";
                exit();
            } else {
                //If database connection is succcessful, begin creating the table
                $checkTable = mysqli_query($establishCon, 'SELECT * from `statusTable`;');
            
                //If the table doesnt exists, create the table
                if(!$checkTable) {
                    $createTable = "CREATE TABLE statusTable (statuscode VARCHAR(5) PRIMARY KEY, status VARCHAR(50), share VARCHAR(12), datePosted DATE, permission VARCHAR(50));";
            
                    $initialiseCreate = mysqli_query($establishCon, $createTable);
                    echo "<p>Table created successfuly</p>";
                }
                //Check if status code is unique by comparing with 'status' table
                //MySQL query to check
                $checkSql = "SELECT * from  `statusTable` WHERE `statuscode` = '$statusCode'";
                //Initialise query above
                $checkUnique = mysqli_query($establishCon, $checkSql);
            
                //If status code is found in the table 
                if (mysqli_num_rows($checkUnique) > 0) {
                        echo "<p>Status code already exists, please enter a unique one</p>";
                        echo "<p style='color:#b32d2d';>Process Failed</p>";
                } else {
                        //If status code is unique, save it into database
                        echo "<p>Status code entered is unique</p>";
                        $insertData = "INSERT INTO statusTable(statuscode,status,share,datePosted,permission) VALUES('$statusCode','$status','$share','$date','$allPermission');";
                        $initialiseInsert = mysqli_query($establishCon, $insertData);
                        //Checks if data insertion is succesful
                        if(!$initialiseInsert) {
                            echo "<p>There is an error with data insertion</p>";
                            echo "<p style='color:#b32d2d';>Process Failed</p>";
                        } else {
                            echo "<p>Entered information will be added into database</p>";
                            echo "<p style='color:#008000';>Process Successful</p>";
                        }
                }
            }
            //Closes connection
            mysqli_close($establishCon);
            
            ?>
         <a href="http://cqp5107.cmslamp14.aut.ac.nz/assign1/searchstatusform.html" class="indexsearch-button">Search status</a>
         <a href="http://cqp5107.cmslamp14.aut.ac.nz/assign1/poststatusform.php" class="indexpost-button">Post another status</a>
         <a href="http://cqp5107.cmslamp14.aut.ac.nz/assign1/index.html" class="back-button">Back To Homepage</a>
      </div>
   </body>
</html>