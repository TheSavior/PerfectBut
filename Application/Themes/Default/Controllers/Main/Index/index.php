<!--<h2>The Wall</h2>

<ul id="nav">
    <li>Most Recent</li>
    <li>Top Posts</li>
    <li>Location</li>
    <li>My Posts</li>
    <li>Favorites</li>
</ul>
-->
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
                <div style="float: right;">
                <?php $fbUrl = $GLOBALS["registry"]->utils->makeLink("Index", "viewPost", $post->id); ?>
                    <div class="fb-like" data-href="<?php echo $fbUrl; ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
                </div>
            </div>
            <div class="underpost">
                Submitted
                <span class="time"><?php echo \Application\Classes\Utils::formatDate($post->date_created); ?></span>
                <!--in
                <span class="location"><?php echo $city?></span>
                    -->
                <div class="ratings">
                    <span class="voteOption upvote" id="<?php echo $post->id?>_up">
                        <span><?php echo $post->upvote?></span>
                        <img src="<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/heart.png"/>
                    </span>
                    <span class="voteOption downvote" id="<?php echo $post->id?>_down">
                        <span><?php echo $post->downvote?></span>
                        <img src="<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/heart_broken.png"/>
                    </span>
                </div>
            </div>
        </div>
        <?php
        }                                    
    ?>
</div>
