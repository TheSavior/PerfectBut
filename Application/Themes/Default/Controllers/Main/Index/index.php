<div id ="TheWall">
    <h2><a href="thewall.html">The Wall</a></h2>
    <?php
        foreach ($this->Posts as $post) {
        ?>
        <div class ="singlepost">
            <span class="posttext">He's perfect but <?php echo $post->text?></span>
            <span class="author"><?php echo $post->poster->username ?></span>
            <span class="upvote" id="<?php echo $post->id?>_up"><?php echo $post->upvote?></span>
            <span class="downvote" id="<?php echo $post->id?>_down"><?php echo $post->downvote?></span>
        </div>
        <?php
        }                                    
    ?>
</div>