<?php
header("Content-type: application/x-javascript");
?>

"use strict";

var url = "<?php echo $_SERVER["ROOT"]?>";                                              
var API_USERS = url + "Api/Users/";
var login = API_USERS + "login";
var userAuth = API_USERS + "currentUser";
var POST = url + "Api/Posts/post/";
var VOTE = url + "Api/Posts/vote/";
var REGISTER = API_USERS + "register";
var PING = url + "Api/Posts/allAfter/";
var TAGLINE = "He's the perfect guy but...";
var SCROLL =  url + "Api/Posts/before/";

var PING_SECONDS = 10;
var TIME_SECONDS = 20;

$(document).ready(function()    {
    $('.upvote').click(function()   {
        updateVoteCount("up" , $(this))
    });

    $('.downvote').click(function() {
        updateVoteCount("down" , $(this))
    });
    $('#querySubmit').click(submitNewPost);
    
    // Keep loading all the new posts
    setInterval(loadPosts, PING_SECONDS * 1000);
    
    setInterval(updateTime, TIME_SECONDS * 1000)
    
    $('#query').keydown(function(event) {
      if (event.keyCode == 13){
        getScrollPosts();
      }
    });

    // If scrollbar is 100 pixels from the bottom
    $(document).scroll(function(){
        if (document.height - (window.pageYOffset + window.innerHeight) < 100) {
            scrollPosts();
        } 
    });

});

// Loads 20 posts to append to bottom
function loadScrollPosts(data)  {
    var wrapper = document.createElement("div");
    $(wrapper).hide();
    $.each(data, function(i){
        var resource = data[i];
        var post = createPost(resource);
        post.appendTo(wrapper);
    });
    $(wrapper).appendTo("#TheWall");
    $(wrapper).fadeIn(1000);
}

// Calls for next 20 posts to add to bottom for the scroll
function scrollPosts()  {
    var oldestTimestamp = $('.singlepost').last().attr('id'); 
    alert(oldestTimestamp);  
    $.ajax(
        {
            dataType: "json",
            "url": SCROLL + oldestTimestamp ,
            success: loadScrollPosts
    });                    
}



// Prints new posts are the become available from ajax call
function printPosts (data)  {
    var firstPost = $(".singlepost")[0];
                     
    var wrapper = document.createElement("div");
    $(wrapper).hide();
    
    var initialCount = $(".singlepost").length;
    
    $.each(data, function(i){
        var resource = data[i];
        var post = createPost(resource);
        post.appendTo(wrapper);
    });
    
    // If we aren't removing anything, stop
    if ($(wrapper).children().length == 0) {
        $(wrapper).remove();
        return;
    }
    
    $(wrapper).prependTo("#TheWall");
    $(wrapper).fadeIn(1000);
    
    var afterCount = $(".singlepost").length;
    
    // We want to remove as many posts off the end so we have as many as we started with
    // We need to do it this way because we don't want to only leave a set number
    // in the case that we add infinite scrolling
    
    var toRemove = afterCount - initialCount;
    if (toRemove > 0) {
        $(".singlepost").slice(-toRemove).remove();
    }
}

function updateTime() {
    $(".singlepost").each(function() {
        var date = formatDate($(this).attr("id"));
        $(this).find(".time").text(date);
    });
}

// This loads new posts and sends data to printPosts
function loadPosts() {
    var firsttime = $($(".singlepost")[0]).attr("id");
    $.ajax(
        {
            dataType: "json",
            "url": PING+firsttime,
            success: printPosts
    });                     
}

// Increments vote counter and sends increment to server
function updateVoteCount(voteType , theCounter)  {
    var url2 = VOTE;
    var targetnum = $("#"+theCounter.attr('id') + 'count').text();
    targetnum = parseInt(targetnum.substring(1));
    $("#"+theCounter.attr('id') + 'count').text("(" + (targetnum + 1) + ")");
    url2 += parseInt(theCounter.attr('id')) + "/" + voteType;
    theCounter.unbind();
    $.post(url2);  
}

// Prints new post if user is logged in depends on signInAjax
function submitNewPost()    {
    var textOfPost = $('#query').val();
    $('#query').val('');

    // TODO: Change to loop over filter file
    textOfPost = textOfPost.toLowerCase().replace(/niggers*/g, 'timothy');
    textOfPost = textOfPost.toLowerCase().replace(/faggots*/g, 'rainbow');

    var $newPost = $('<div>').addClass('singlepost').prependTo('#TheWall');
    $newPost.hide();
    var $posttext = $('<div>').addClass('posttext').appendTo($newPost);
    $('<span>').addClass('intro').text('He\'s the perfect guy but...').appendTo($posttext);
    $('<br>').appendTo($posttext);
    $('<span>').addClass('text').text(textOfPost).appendTo($posttext);
    var $underpost = $('<div>').addClass('underpost').appendTo($newPost);
    $('<span>').text('Submitted ').appendTo($underpost);
    $('<span>').addClass('time').text('Just Now').appendTo($underpost);
    var $ratings = $('<div>').addClass('ratings').appendTo($posttext);
    var $voteOption = $('<span>').addClass('voteOption upvote').appendTo($ratings);
    $('<span>').text('(0)').appendTo($voteOption);
    $('<img>').attr('src' , 'http://tranquil-wave-1815.herokuapp.com/Application/Themes/Default/Images/ring_big.png').appendTo($voteOption);
    $('<span>').text('Take Him').appendTo($voteOption);
    var $voteOption2 = $('<span>').addClass('voteOption downvote').appendTo($ratings);
    $('<span>').text('(0)').appendTo($voteOption2);
    $('<img>').attr('src' , 'http://tranquil-wave-1815.herokuapp.com/Application/Themes/Default/Images/run_big.png').appendTo($voteOption2);
    $('<span>').text('Leave Him').appendTo($voteOption2);
    $newPost.fadeIn(500);

    $.post(POST,
        {text : textOfPost} 
    );
}