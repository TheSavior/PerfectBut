<?php
    $this->registerHelper("fb", "Application\Themes\Helpers\Facebook");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->getThemeLocation()?>/Images/favicon.ico" />
        <?php echo $this->headStyles() ?>
        <?php echo $this->headScripts() ?>
        
        <title>Meet</title>
    </head>
    <body>
        <div id="container">
            <a name="top"></a>
            <div id="logostrip">
                <!--<img src="themes/Default/images/header.jpg" alt="" />-->
            </div>
            <div id="container2">
                <?php
                echo $this->content() 
                ?>
            </div>
            <div id="copyright">
                Meet!<br />
                &copy; <a href="http://www.eli-white.com">Eli White</a><br />
                All Rights Reserved
            </div>
        </div>
    </body>
</html>