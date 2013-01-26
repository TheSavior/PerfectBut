<div class="titlebar">Welcome</div>
<div>

<?php

    foreach ($this->Posts as $post) {
          echo '<p>
                He\'s perfect but '.$post->text.' by '.$post->poster->username.'<br />
                <span style="color: green">'.$post->upvote.'<span> - <span style="color: red">'.$post->downvote.'</span><br />
                </p>';
    }                                    
?>
You are using Saros Framework V<?php echo $this->Version ?>
</div>