<<<<<<< HEAD
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
    var url2 = VOTE;
    url2 += parseInt(theCounter.attr('id')) + "/" + voteType;
    var voteNum = parseInt(theCounter.text()) + 1;
    theCounter.text(voteNum);
    $.ajax({
            "url": url2 ,
            dataType: 'json' 
    });  
}

// Prints new post if user is logged in depends on signInAjax
function submitNewPost(data)    {
    if(data != "")    {
        var textOfPost = $('#query').val();
        var $newPost = $('<div>').addClass('singlepost').prependTo('#TheWall');
        var $posttext = $('<div>').addClass('posttext').appendTo($newPost);
        $('<span>').addClass('intro').text('he\'s the perfect guy but...').appendTo($posttext);
        $('<br>').appendTo($posttext);
        $('<span>').addClass('text').text(textOfPost).appendTo($posttext);
        var $underpost = $('<div>').addClass('underpost').appendTo($newPost);
        $('<span>').addClass('author').text(data).appendTo($underpost);
        $('<span>').text(' submitted ').appendTo($underpost);
        $('<span>').addClass('time').text('Just Now').appendTo($underpost);
        $('<span>').addClass('location').text(' in Seattle').appendTo($underpost);
        var $ratings = $('<div>').addClass('ratings').appendTo($underpost);
        var $voteOption = $('<span>').addClass('voteOption upvote').appendTo($ratings);
        $('<span>').addClass('upvote').text('0').appendTo($voteOption);
        $('<img>').attr('src' , 'http://localhost/PerfectBut/Application/Themes/Default/Images/heart.png').appendTo($voteOption);
        var $voteOption2 = $('<span>').addClass('voteOption downvote').appendTo($ratings);
        $('<span>').addClass('downvote').text('0').appendTo($voteOption2);
        $('<img>').attr('src' , 'http://localhost/PerfectBut/Application/Themes/Default/Images/heart_broken.png').appendTo($voteOption2);

        
        $.post(POST,
            {text : textOfPost} 
        )
    }
}


// Checks to see if user is logged in
function signInAjax()   {
    $.ajax({
        "url": userAuth,
        success: submitNewPost ,
        error: showLogin
    })
}

// If user is not logged in, show the login prompt
function showLogin()    {
    $('#loginPopup').show();
}

// checks to see if login is valid
function userLogin()    {
    var $userName = $('#username').val();
    var $userPass = $('#password').val();
    $.post(login ,
        {username : $userName , password : $userPass} , 
    

    function() { $('#loginPopup').hide(); })
}
=======
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
var CREATE = API_USERS + "register";

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

// Make a new fucking account, what do you think?
function makeNewAccount() {
    
} 


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
    var voteNum = parseInt(theCounter.text()) + 1;
    theCounter.text(voteNum);
    $.ajax({
            "url": url2 ,
            dataType: 'json' 
    });  
}

// Prints new post if user is logged in depends on signInAjax
function submitNewPost(data)    {
    if(data != "")    {
        var textOfPost = $('#query').val();
        var $newPost = $('<div>').addClass('singlepost').prependTo('#TheWall');
        var $posttext = $('<div>').addClass('posttext').appendTo($newPost);
        $('<span>').addClass('intro').text('he\'s the perfect guy but...').appendTo($posttext);
        $('<br>').appendTo($posttext);
        $('<span>').addClass('text').text(textOfPost).appendTo($posttext);
        var $underpost = $('<div>').addClass('underpost').appendTo($newPost);
        $('<span>').addClass('author').text(data).appendTo($underpost);
        $('<span>').text(' submitted ').appendTo($underpost);
        $('<span>').addClass('time').text('Just Now').appendTo($underpost);
        $('<span>').addClass('location').text(' in Seattle').appendTo($underpost);
        var $ratings = $('<div>').addClass('ratings').appendTo($underpost);
        var $voteOption = $('<span>').addClass('voteOption upvote').appendTo($ratings);
        $('<span>').addClass('upvote').text('0').appendTo($voteOption);
        $('<img>').attr('src' , 'http://localhost/PerfectBut/Application/Themes/Default/Images/heart.png').appendTo($voteOption);
        var $voteOption2 = $('<span>').addClass('voteOption downvote').appendTo($ratings);
        $('<span>').addClass('downvote').text('0').appendTo($voteOption2);
        $('<img>').attr('src' , 'http://localhost/PerfectBut/Application/Themes/Default/Images/heart_broken.png').appendTo($voteOption2);
        $.post(POST,
            {text : textOfPost} 
        )
    }
}


// Checks to see if user is logged in
function signInAjax()   {
    $.ajax({
        "url": userAuth,
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
    $.post(login ,
        {username : $userName , password : $userPass} ,
    function() { $('#loginPopup').hide();
    })
}
>>>>>>> b171434d422831dbf61f213d83661d74b17a7b5d
