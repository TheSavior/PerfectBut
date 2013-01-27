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
        ?>
        <div class ="singlepost">
            <div class="posttext">
                <span class="intro">He's the perfect guy but...</span><br />
                <span class="text"><?php echo $post->text?></span>
            </div>
            <div class="underpost">
                <span class="author"><?php echo $post->poster->username ?></span> submitted
                <span class="time post_<?php echo $post->date_created?>"><?php echo \Application\Classes\Utils::formatDate($post->date_created); ?></span>
                in
                <span class="location"><?php echo $post->city?></span>
                
                <div class="ratings">
                    <span class="voteOption upvote">
                        <span id="<?php echo $post->id?>_up"><?php echo $post->upvote?></span>
                        <img src="<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/heart.png"/>
                    </span>
                    <span class="voteOption downvote">
                        <span id="<?php echo $post->id?>_down"><?php echo $post->downvote?></span>
                        <img src="<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/heart_broken.png"/>
                    </span>
                </div>
            </div>
        </div>
        <?php
        }                                    
    ?>
</div>
