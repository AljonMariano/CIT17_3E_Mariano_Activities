<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>constant() example</title>
    </head>
    <body>
       <?php
       define("MINSIZE", 50);
       echo MINSIZE;
       echo constant("MINSIZE"); // same thing as the previous line
       ?>
    </body>
</html>