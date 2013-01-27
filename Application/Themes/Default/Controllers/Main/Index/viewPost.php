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
        <div class="singlepost" id="<?php echo $post->date_created?>">
            <div class="posttext">
                <span class="intro">He's the perfect guy but...</span><br />
                <span class="text"><?php echo $post->text?></span>
                <div class="ratings">
                    <span class="voteOption upvote" id="<?php echo $post->id?>_up">
                        <span><?php echo $post->upvote?></span>
                        <img src="<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/ring.png"/>
                    </span>
                    <span class="voteOption downvote" id="<?php echo $post->id?>_down">
                        <span><?php echo $post->downvote?></span>
                        <img src="<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/run.png"/>
                    </span>
                </div>
                <div style="float: right;">
                    <div class="fb-like" data-href="http://perfectguybut.com/Index/viewPost/2" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
                </div> 
            </div>
            <div class="underpost">
                Submitted
                <span class="time"><?php echo \Application\Classes\Utils::formatDate($post->date_created); ?></span>
                <!--in
                <span class="location"><?php echo $city?></span>
                    -->
                
            </div>
        </div>
        <?php 
    }                                   
    ?>
</div>
