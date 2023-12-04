<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP Global Variables</title>
    </head>
    <body>
       <?php
       $somevar = 15;
       function addit() {
       GLOBAL $somevar;
       $somevar++;
       print "Somevar is $somevar";
       }
       addit();
    

       ?>
        
        
    </body>
</html>