<?php
header("Content-type: application/x-javascript");

?>

"use strict";

var url = "<?php echo $_SERVER["ROOT"]?>";



$(document).ready(function()    {
    $('.upvote').click(function()   {
        updateVoteCount("up" , $(this))
    });

    $('.downvote').click(function() {
        updateVoteCount("down" , $(this))
    });
    $('#querySubmit').click(signInAjax);
    //loadPosts();
    $('#userLogin').click(userLogin);
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

// Prints new post if user is logged in depends on signInAjax
function submitNewPost(data)    {
    if(data != null)    {
        var textOfPost = $('#query').val();
        var $newPost = $('<div>').addClass('singlepost').prependTo('#TheWall');
        $('<span>').addClass('posttext').text(textOfPost).appendTo($newPost);
        $('<span>').addClass('author').text(data).appendTo($newPost);
        $('<span>').addClass('upvote').text("0").appendTo($newPost);
        $('<span>').addClass('downvote').text("0").appendTo($newPost);
        $('<p>').addClass('time').text("").appendTo($newPost);
        $.post("http://localhost/PerfectBut/Api/Posts/post/",
        {text : textOfPost} 
        )
    }
}


// Checks to see if user is logged in
function signInAjax()   {
    $.ajax({
        "url": "http://localhost/PerfectBut/Api/Users/currentUser",
        success: submitNewPost ,
        error: showLogin
    })
}

// If user is not logged in, show the login prompt
function showLogin()    {
    $('#loginPopup').show();
}

function userLogin()    {
    var $userName = $('#username').val();
    var $userPass = $('#password').val();
    $.post("http://localhost/PerfectBut/Api/Users/login" ,
    {username : $userName , password : $userPass} ,
    function() { $('#loginPopup').hide();
    })
}
