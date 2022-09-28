	$(document).ready(function(){
		$('#js-data-state-ajax').select2({
		  dropdownParent: $('#js-data-state-modal'),
		  selectOnClose: true,
		  ajax: {
			url: "/admin/states/list",
			type: "get",
			dataType: 'json',
			data: function (params) {
				return {
				  search: params.term // search term
				};
		  },
		  processResults: function (response) {
			    if($("#js-data-wards-ajax").length > 0) {
					$("#js-data-wards-ajax").val(null).trigger("change");
				}
				
				if($("#js-data-pu-ajax").length > 0) {
					$("#js-data-pu-ajax").val(null).trigger("change");
				}
				return {
				  results: response
				};
			  },
		  cache: true
		  }
			  
		});
	});
