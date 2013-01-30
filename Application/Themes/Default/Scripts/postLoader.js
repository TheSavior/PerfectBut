<?php
header("Content-type: application/x-javascript");
?>

"use strict";
    
function createPost(data) {
    //console.log(data);
    var newpost = $($(".singlepost")[0]).clone();
    
    newpost.attr("id", data.timestamp);
    newpost.find(".text").text(data.text);
    var upvote = newpost.find(".upvote").attr("id", data.id+"_up").click(function() {
        updateVoteCount("up" , $(this))
    });
    upvote.find(".votecount").attr("id", data.id+"_upcount").text("("+data.upvotes+")");
                                                                 
    var downvote = newpost.find(".downvote").attr("id", data.id+"_down").click(function() {
        updateVoteCount("up" , $(this))
    });
    downvote.find(".votecount").attr("id", data.id+"_downcount").text("("+data.downvotes+")");
    
    newpost.find(".time").text(data.whenstring);
    
    return newpost;                  
}