
(function($) {
    "use strict"	
	// table row
	var table = $('#example3').DataTable({
		language: {
			paginate: {
			  next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
			  previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' 
			}
		  }
	});
	$('#example tbody').on('click', 'tr', function () {
		var data = table.row( this ).data();
	});
   
	
	
})(jQuery);
