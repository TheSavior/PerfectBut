<div class="titlebar">Welcome</div>
<div>

<ul>
<?php

    foreach ($this->Posts as $post) {
          echo "<li>".$post->text." by ".$post->poster->username." +".$post->upvote." -".$post->downvote."</li>";
    }
?>
</ul>
You are using Saros Framework V<?php echo $this->Version ?>
</div>