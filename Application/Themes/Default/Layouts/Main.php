<?php
    $auth = \Saros\Auth::getInstance();
?>

<html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Perfect Guy But...</title>
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->getThemeLocation()?>/Images/favicon.ico" />
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css"/>           
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css">
        <?php echo $this->headStyles()->addStyle("Main") ?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Kavoon' rel='stylesheet' type='text/css'>
        <?php echo $this->headScripts()->addScript("index") ?>
    </head>
    <body>
        <div id="banner">
                <div id = "name">
                    <p>PERFECTGUYBUT.COM<p>
                </div>
                <h1>He's The <br /> Perfect Guy But...</h1>
                 <p><input type="text" id="query" autofocus="autofocus"><button id="querySubmit">Post</button></p>
            </div>  
        <div id="container">  
            <div id = "loginPopup" display="none">
                <div id="pointer">
                  <!-- pointer for the login popup -->
                </div>
                <label><span>Nickname</span><input type="text" id="username" autofocus="autofocus"></label><br />
                <label><span>Password</span><input type="password" id="password" autofocus="autofocus"></span></label>
            </div>    

            <?php
                echo $this->content() 
            ?>
        </div>
        <div id="footer">
            <?php echo \Spot\Log::queryCount() ?> Queries
        </div>
    </body>
</html>