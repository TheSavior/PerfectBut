$(document).ready(function()	{
        loadPosts();
});


function printPosts (data)	{
	 alert(data);
	 $.each(data, function(i){
           
            var resource = data.response[i];
            var $newPost = $('<div>').addClass('singlepost').appendTo('TheWall')
			$('<a>').addClass('posttext').text(resource.text).appendTo($newPost);
			$('<p>').addClass('upvote').text(resource.upvotes).appendTo($newPost);
			$('<p>').addClass('downvote').text(resource.downvotes).appendTo($newPost);
			$('<p>').addClass('author').text(resource.username).appendTo($newPost);
			$('<p>').addClass('time').text(resource.timestamp).appendTo($newPost);
 
        });
}

function loadPosts()	{
  	var url = "http://localhost/PerfectBut/Api/Posts/getAll";
 	$.ajax({
            url: url ,
            dataType: 'jsonp' ,
            success: printPosts 
    });
}