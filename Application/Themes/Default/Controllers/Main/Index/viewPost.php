<div id ="TheWall">
    <?php if ($this->Failure)
    {
        ?>
        <div class ="singlepost">
            <div class="posttext">
                <span class="intro">Invalid Post id</span><br />
                <span class="text">Nothing to see here</span>
            </div>
            <div class="underpost">
            </div>
        </div>
        <?php
    }
    else
    {
        $post = $this->Post;
        $city = "Unknown";
        
        if ($post->city)
            $city = $post->city;
        ?>
        <div class ="singlepost">
            <div class="posttext">
                <span class="intro">He's the perfect guy but...</span><br />
                <span class="text"><?php echo $post->text?></span>
                <div style="float: right;">
                    <div class="fb-like" data-href="http://perfectguybut.com/Index/viewPost/2" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
                </div>
            </div>
            <div class="underpost">
                <span class="author"><?php echo $post->poster->username ?></span> submitted
                <span class="time post_<?php echo $post->date_created?>"><?php echo \Application\Classes\Utils::formatDate($post->date_created); ?></span>
                in
                <span class="location"><?php echo $city?></span>
                
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
