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
                <span id="intro">He's the perfect guy but...</span><br />
                <span id="text"><?php echo $post->text?></span>
            </div>
            <div class="underpost">
                <span class="author"><?php echo $post->poster->username ?></span>
                <span class="upvote" id="<?php echo $post->id?>_up"><?php echo $post->upvote?></span>
                <span class="downvote" id="<?php echo $post->id?>_down"><?php echo $post->downvote?></span>
                <p>Submitted <em>5 hours ago</em> by <em>yay gurl</em> </p>
                <img id="baby" src='<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/baby.png' alt="baby">  
                <img id="baby" src='<?php echo $_SERVER["ROOT"]?>Application/Themes/Default/Images/trash.png' alt="trash">  
            </div>
        </div>
        <?php
        }                                    
    ?>
</div>