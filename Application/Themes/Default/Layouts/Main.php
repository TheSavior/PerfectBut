<?php
    $auth = \Saros\Auth::getInstance();
?>

<html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Perfect Guy But...</title>
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/themes/base/jquery-ui.css"/>           
        <link href='http://fonts.googleapis.com/css?family=Kavoon' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Knewave' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css">
        <?php echo $this->headStyles()->addStyle("Main") ?>
        
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->getThemeLocation()?>/Images/favicon.ico" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>
        <link rel="shortcut icon" href="<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/favicon.ico" type="image/x-icon" />
        <?php echo $this->headScripts()->addScript("index")->addScript("postLoader")->addScript("time") ?>
    </head>
    <body>
           <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=123534114485999";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

            <div id="banner">
                <h1><span>He's The</span><br /><span>Perfect Guy But...</span></h1>
                <div id="queryp"><input type="text" id="query" autofocus="autofocus" placeholder = "Enter between 10 and 160 chars"><button id="querySubmit"></button></div>
                <div id = "loginPopup">
                    <div id="pointer">
                        <!-- pointer for the login popup -->
                    </div>
                    <label><span>Nickname</span><input type="text" id="username"  name = "username" autofocus="autofocus"></label><br />
                    <label><span>Password</span><input type="password" id="password" name = "password" autofocus="autofocus"></span></label>
                    <br>
                     <button id = "userLogin">Login</button>
                     <button id = "registerButton">Make a new account</button>
                </div>  
            </div>
        <div id="container">
            <div id="pagelike" class="fb-like-box" data-href="http://www.facebook.com/PerfectGuyBut" data-width="292" data-show-faces="false" data-stream="false" data-header="true"></div>

            <div id="tail">
            </div> 
            <?php
                echo $this->content() 
            ?>
        </div>
    </body>
    
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-37992866-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>              
</html>