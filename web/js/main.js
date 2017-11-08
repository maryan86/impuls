$(document).ready(function() {

	$("#table-books tbody tr").mouseout(function(e) {
		$('.image img').hide();
	});

	$("#table-books tbody tr").mousemove(function(e) {
		$('.image img').hide();
		var self = $(this);
		var offset = $('body').offset();
		var relativeX = (e.pageX - offset.left);
		var relativeY = (e.pageY - offset.top);
		self.find('.image img').css({'left':  relativeX+10, 'top': relativeY+20, 'display': 'block'});
	});
});
