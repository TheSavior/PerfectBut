
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
    $('#registerButton').click(register);
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
            type : POST ,
            "url": url2 ,
            dataType: 'json' 
    });  
}

// Prints new post if user is logged in depends on signInAjax
function submitNewPost(data)    {
    if(data != null)    {
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
        );
    }
}

function register() {
    $.post(REGISTER,
        {
            username: $('#username').val(),
            password: $('#password').val()
        }
    );
}


// Checks to see if user is logged in
function signInAjax()   {
    $.ajax({
        "url": userAuth,
        success : submitNewPost
    });

}

// checks to see if login is valid
function userLogin()    {
    var $userName = $('#username').val();
    var $userPass = $('#password').val();
    $.ajax({
        "url" : login ,
        data : {username : $userName , password : $userPass} , 
        type: POST ,
        statusCode : {
            200 : function() { 
                $('#loginPopup').hide(); 
            } ,

            400 :  function() { 
                alert('Please fill out both uername and password');
            } ,

            401 : function() { 
                alert('Please try again'); 
            }
        }
    });
        
}

