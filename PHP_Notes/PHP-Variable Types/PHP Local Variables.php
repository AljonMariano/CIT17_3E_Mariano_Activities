<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP Local Variables</title>
    </head>
    <body>
       <?php
       
       $x = 4;
       function assignx () {
        $x = 0;
        print "\$x inside function is $x. ";
        }
        assignx();
        print "\$x outside of function is $x. ";


       ?>
        
        
    </body>
</html>