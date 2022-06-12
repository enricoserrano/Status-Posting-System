<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel = "stylesheet" type = "text/css" href = "styles.css"/>
      <title>Post Status Page</title>
   </head>
   <body>
      <div class="box-container">
         <h1>Status Posting System</h1>
         <form action ="poststatusprocess.php" method = "POST">
            <p>
               <label>Status Code (required): </label>
               <input class="statuscodetext" type="text" pattern="^S[0-9]{4}" name ="statuscode" title="Must start with uppercase 'S', followed by 4 digits e.g. S0002" required="required">
            </p>
            <p>
               <label>Status: </label>
               <input id="statusvalidation" class="statustext" type="text" name ="status" pattern="^[\w,.!?][\s\w,.!?]*$" title="Your status 
                  is in a wrong format! The status can only contain alphanumericals and spaces, comma, period, 
                  exclamation point and question mark and cannot be blank!" required="required">
            </p>
            <p>
               <label>Share: </label>
               <input type="radio" name ="share" value ="Public" required="required"> Public
               <input type="radio" name ="share" value ="Friends"> Friends
               <input type="radio" name ="share" value ="Only me"> Only Me
            </p>
            <p>
               <label>Date: <input type="date" name ="date" value="<?php echo date('Y-m-d'); ?>" required="required" onkeydown="return false"></label>
            </p>
            <p>
               <label>Permission Type: </label>
               <input type="checkbox" name="permission[]" value="Allow Like"> Allow Like
               <input type="checkbox" name="permission[]" value="Allow Comment"> Allow Comment
               <input type="checkbox" name="permission[]" value="Allow Share"> Allow Share
            </p>
            <input type="reset" value="Reset">
            <input type="submit" value="Post" name="submit">
         </form>
         <br>
         <a href="http://cqp5107.cmslamp14.aut.ac.nz/assign1/index.html" class="back-button">Back To Homepage</a>
      </div>
   </body>
</html>
<script>
   document.getElementById("statusvalidation").addEventListener('keydown', function (j) {
     if (this.value.length === 0 && j.which === 32) j.preventDefault();
   });
</script>