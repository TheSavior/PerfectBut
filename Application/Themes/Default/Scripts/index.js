
<?php
header("Content-type: application/x-javascript");

?>

"use strict";

var url = "<?php echo $_SERVER["ROOT"]?>";                                              
var API_USERS = url + "Api/Users/"
var login = API_USERS + "login";
var userAuth = API_USERS + "currentUser";
var POST = url + "Api/Posts/post/";
var VOTE = url + "Api/Posts/vote/";
var REGISTER = API_USERS + "register";
var PING = url + "Api/Posts/allAfter/"
var TAGLINE = "He's the perfect guy but...";

$(document).ready(function()    {
    $('.upvote').click(function()   {
        updateVoteCount("up" , $(this))
    });

    $('.downvote').click(function() {
        updateVoteCount("down" , $(this))
    });
    $('#querySubmit').click(submitNewPost);
    //loadPosts();
    $('#query').keydown(function(event) {
      if (event.keyCode == 13){
        submitNewPost();
      }
    });
    createPinger();
});


// Prints new posts are the become available from ajax call
function printPosts (data)  {
    alert(data);
    $.each(data, function(i){
        var resource = data[i];
        var $newPost = $('<div>').addClass('singlepost').appendTo('#TheWall');
        $('<span>').addClass('posttext').text(resource.text).appendTo($newPost);
        $('<span>').addClass('upvote').text(resource.upvotes).appendTo($newPost);
        $('<span>').addClass('downvote').text(resource.downvotes).appendTo($newPost);
        $('<span>').addClass('author').text(resource.username).appendTo($newPost);
        $('<p>').addClass('time').text(resource.timestamp).appendTo($newPost);

    });
}

// This loads new posts and sends data to printPosts
function loadPosts()    {
    $.ajax(
        {
            dataType: "json",
            "url": url + "/Api/Posts/getAll",
            success: printPosts
    });                     
}

// Increments vote counter and sends increment to server
function updateVoteCount(voteType , theCounter)  {
    var url2 = VOTE;
    url2 += parseInt(theCounter.attr('id')) + "/" + voteType;
    alert(theCounter);
    var voteNum = substring(0).parseInt(theCounter.text()) + 1;
    alert(voteNum);
    theCounter.text(voteNum);
    $.post(url2);  
}

// Prints new post if user is logged in depends on signInAjax
function submitNewPost()    {
    var textOfPost = $('#query').val();
    var textOfPost = textOfPost.toLowerCase().replace('nigger', 'timothy');
    var textOfPost = textOfPost.toLowerCase().replace('niggers', 'people');
    var textOfPost = textOfPost.toLowerCase().replace('faggot', 'rainbow');
    var textOfPost = textOfPost.toLowerCase().replace('faggots', 'rainbows');
    var $newPost = $('<div>').addClass('singlepost').prependTo('#TheWall');
    $newPost.hide();
    var $posttext = $('<div>').addClass('posttext').appendTo($newPost);
    $('<span>').addClass('intro').text('He\'s the perfect guy but...').appendTo($posttext);
    $('<br>').appendTo($posttext);
    $('<span>').addClass('text').text(textOfPost).appendTo($posttext);
    var $underpost = $('<div>').addClass('underpost').appendTo($newPost);
    $('<span>').text('Submitted ').appendTo($underpost);
    $('<span>').addClass('time').text('Just Now').appendTo($underpost);
    $('<span>').addClass('location').text(' in Seattle').appendTo($underpost);
    var $ratings = $('<div>').addClass('ratings').appendTo($posttext);
    var $voteOption = $('<span>').addClass('voteOption upvote').appendTo($ratings);
    $('<span>').text('(0)').appendTo($voteOption);
    $('<img>').attr('src' , 'http://tranquil-wave-1815.herokuapp.com/Application/Themes/Default/Images/ring_big.png').appendTo($voteOption);
    $('<span>').text('Take Him').appendTo($voteOption);
    var $voteOption2 = $('<span>').addClass('voteOption downvote').appendTo($ratings);
    $('<span>').text('(0)').appendTo($voteOption2);
    $('<img>').attr('src' , 'http://tranquil-wave-1815.herokuapp.com/Application/Themes/Default/Images/ring_big.png').appendTo($voteOption2);
    $('<span>').text('Leave Him').appendTo($voteOption2);
    $newPost.fadeIn(500);
    $('#query').val('');

    $.post(POST,
        {text : textOfPost} 
    );
}



function createPinger() {
    setTimeout(function() {
        ping();
    }, 10000);
}


function ping() {
    createPinger();
    var timeStamp = $('.singlePost')[0].id;
    $.ajax({
        "url": PING + timeStamp,
        success: printPosts
    });
}
