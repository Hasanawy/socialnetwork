
postId = 0;
postBodyElement = null ;
			
$(document).ready(function(){





	$.ajaxSetup(
	{
	    headers: 
	    {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	

	$('.post').find('.interaction').find('.edit').on('click' ,function(event)
		{
			event.preventDefault();

			postBodyElement = event.target.parentNode.parentNode.childNodes[1];
			var postBody = postBodyElement.textContent;
			postId = event.target.parentNode.parentNode.dataset['postid'];
			$('#post-body').val(postBody);
			$('#edit-modal').modal();
			
		});

	$('#modal-save').on('click' , function()
		{
			$.ajax({
				method: 'POST',
				url: urlEdit,
				data: { body: $('#post-body').val()  , postId: postId   },
			}) 
				.done(function(msg)
					{
						$(postBodyElement).text(msg['new_body']);
						$('#edit-modal').modal('hide');
					});
		});

	$('.like').on('click' , function(event)
	{
		event.preventDefault();
		postId = event.target.parentNode.parentNode.dataset['postid'];
		var isLike = event.target.previousElementSibling == null ; 
		$.ajax({
			method: 'POST',
			url: urlLike,
			data: {isLike: isLike , postId: postId , },
		}) 
			.done(function()
				{
					//Change The Page
					event.target.innerText = isLike ? event.target.innerText == 'Like' ? 'You Like This Post' : 'Like' : event.target.innerText == 'Dislike' ? 'You Don\'t Like This Post' : 'Dislike';
					if(isLike){
						event.target.nextElementSibling.innerText = 'Dislike' ;
					}else {
						event.target.previousElementSibling.innerText = 'Like';
					}
				});
	});





});