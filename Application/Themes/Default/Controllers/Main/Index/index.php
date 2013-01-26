<div id ="TheWall">
    <h2><a href="thewall.html">The Wall</a></h2>

    <?php

        foreach ($this->Posts as $post) {
        ?>
        <div class ="singlepost">
            <span class="posttext">He's perfect but <?php echo $post->text?></span>
            <a class="author"><?php echo $post->poster->username ?></a>
            <a class="upvote"><?php echo $post->upvote?></a>
            <a class="downvote"><?php echo $post->downvote?></a>
        </div>
        <?php
        }                                    
    ?>
    </div>
</div>