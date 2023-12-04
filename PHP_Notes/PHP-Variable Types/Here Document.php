<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Here Document</title>
    </head>
    <body>
       <?php
       $channel =<<<_XML_
       <channel>
       <title>What's For Dinner<title>
       <link>http://menu.example.com/<link>
       <description>Choose what to eat tonight.</description>
       </channel>
       _XML_;
       echo <<<END
       This uses the "here document" syntax to output \n
       multiple lines with variable interpolation. Note
       that the here document terminator must appear on a
       line with just a semicolon. no extra whitespace!
       <br />
       END;
       print $channel;
    

       ?>
        
        
    </body>
</html>