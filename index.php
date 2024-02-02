<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "
    http://www.w3.org/TR/html4/loose.dtd">
<!-- Server Side WEB Development -->
<!-- Unit 2: Working with databases in PHP -->
<!-- Exercise: PDO Prepared Querys -->
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title>F1 cars</title>
        <link href="f1.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1><center>F1 Cars</center></h1>
            </div>
            <div id="menu">
            </div>

            <div id="content">
                <?php
                
                /*
                 * You must include a php file in the index page 
                 * containing three functions 
                 * to update, delete and list the car table.
                 */
                include_once 'cars.php';

                conect();
                
                if(isset($_POST['Update'])){
                    update();
                }
                
                if(isset(($_POST['Delete']))){
                    delete();
                }
                
                 completeTable();
                 
                 disconnet();
                /*
                 * You must check if an operation to update or delete
                 * has been received and call to the correct function 
                 * defined in the file previously included
                 * 
                 * After that you must always to call the function to show all the cars
                 */
                
                
                ?>
            </div>
            
        </div>
        <div id="foot">
            <h3><center>Kirissa Povedano Garcia </center></h3>
                <h3><center>Antonio Ladesa Jurado</center></h3>
            </div>
    </body>
</html>
