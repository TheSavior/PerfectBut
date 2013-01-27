<!--<h2>The Wall</h2>-->

<div id="ads">
    <!-- Begin: adBrite, Generated: 2013-01-27 2:11:07  -->
    <style type="text/css">
       .adHeadline {font: bold 10pt Arial; text-decoration: underline; color: #0000FF;}
       .adText {font: normal 10pt Arial; text-decoration: none; color: #000000;}
    </style>
    <script type="text/javascript">
    var AdBrite_Page_Url = '';
    try{var AdBrite_Iframe=window.top!=window.self?2:1;var AdBrite_Referrer=document.referrer==''?document.location:document.referrer;AdBrite_Referrer=encodeURIComponent(AdBrite_Referrer);}catch(e){var AdBrite_Iframe='';var AdBrite_Referrer='';}
    document.write(String.fromCharCode(60,83,67,82,73,80,84));document.write(' src="http://ads.adbrite.com/mb/text_group.php?sid=2280247&br=1&dk=63617220696e737572616e63655f355f325f776562&ifr='+AdBrite_Iframe+'&ref='+AdBrite_Referrer+'&purl='+encodeURIComponent(AdBrite_Page_Url)+'" type="text/javascript">');document.write(String.fromCharCode(60,47,83,67,82,73,80,84,62));</script>
    <div><a class="adHeadline" target="_top" href="http://www.adbrite.com/mb/commerce/purchase_form.php?opid=2280247&afsid=1">Your Ad Here</a></div>
    <!-- End: adBrite -->
</div>

<div id ="TheWall">
    <?php
        foreach ($this->Posts as $post) {
            $city = "Unknown";
            
            if ($post->city)
                $city = $post->city;
        ?>
        <div class="singlepost" id="<?php echo $post->date_created?>">
            <div class="posttext">
                <span class="intro">He's the perfect guy but...</span><br />
                <span class="text"><?php echo $post->text?></span>
                <div class="ratings">
                    <span class="voteOption upvote" id="<?php echo $post->id?>_up">
                        <span>(<?php echo $post->upvote?>)</span>
                        <img src="<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/ring_big.png"/>
                        <span>Take Him</span>
                    </span>
                    <span class="voteOption downvote" id="<?php echo $post->id?>_down">
                        <span>(<?php echo $post->downvote?>)</span>
                        <img src="<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/run_big.png"/>
                        <span>Leave Him</span>
                    </span>
                </div>
                <!--<div style="float: right;">
                <?php $fbUrl = $GLOBALS["registry"]->utils->makeLink("Index", "viewPost", $post->id); ?>
                    <div class="fb-like" data-href="<?php echo $fbUrl; ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
                </div>-->
            </div>
            <div class="underpost">
                Submitted
                <span class="time"><?php echo \Application\Classes\Utils::formatDate($post->date_created); ?></span>
            </div>
        </div>
        <?php
        }                                    
    ?>
</div>
