<?php
header("Content-type: application/x-javascript");
?>

"use strict";

var url = "http://localhost/PerfectBut/Api/Posts/getAll";



$(document).ready(function()    {
    $('.upvote').click(function()   {
        updateVoteCount("up" , $(this))
});

    $('.downvote').click(function() {
        updateVoteCount("down" , $(this))
});
    //loadPosts();
});


function printPosts (data)  {
    alert(data);
    $.each(data, function(i){
        var resource = data[i];
        var $newPost = $('<div>').addClass('singlepost').appendTo('TheWall');
        $('<a>').addClass('posttext').text(resource.text).appendTo($newPost);
        $('<p>').addClass('upvote').text(resource.upvotes).appendTo($newPost);
        $('<p>').addClass('downvote').text(resource.downvotes).appendTo($newPost);
        $('<p>').addClass('author').text(resource.username).appendTo($newPost);
        $('<p>').addClass('time').text(resource.timestamp).appendTo($newPost);

    });
}

function loadPosts()    {
    $.ajax(
        {
            dataType: "json",
            url: url,
            success: printPosts
    });                     
}

function updateVoteCount(voteType , theCounter)  {
    var url2 = "http://localhost/PerfectBut/Api/Posts/vote/";
    url2 += parseInt(theCounter.attr('id')) + "/" + voteType;
    var voteNum = parseInt(theCounter.text()) + 1;
    console.log(url2);

    theCounter.text(voteNum);
    $.ajax({
            "url": url2 ,
            dataType: 'json' 
    });  

}

