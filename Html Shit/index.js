$(document).ready(function()	{
	$(document).scroll(function(){
        if (($(document).height() - $(window).height() - $(document).scrollTop()) < 100) {
           loadPosts();
        }
    });
}):


function loadPosts()	{
	for(var i = 0 ; i < 10 ; i++)	{
			var $newPost = $('<div>').addClass
	}	
}