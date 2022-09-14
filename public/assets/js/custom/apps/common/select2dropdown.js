	$(document).ready(function(){
		$('#js-data-lga-ajax').select2({
		  dropdownParent: $('#js-data-lga-modal'),
		  selectOnClose: true,
		  ajax: {
			url: "/lgas/list",
			type: "get",
			dataType: 'json',
			data: function (params) {
				return {
				  search: params.term // search term
				};
		  },
		  processResults: function (response) {
				$("#js-data-wards-ajax").val(null).trigger("change");
				$("#js-data-pu-ajax").val(null).trigger("change");
				return {
				  results: response
				};
			  },
		  cache: true
		  }
			  
		});
	});
	
	$(document).ready(function(){
		// CSRF Token
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			
		$('#js-data-wards-ajax').select2({
		  dropdownParent: $('#js-data-wards-modal'),
		  selectOnClose: true,
		  ajax: {
			url: "/wards/list",
			type: "post",
			dataType: 'json',
			data: function (params) {
				return {
				  _token: CSRF_TOKEN,	
				  lga_id: $('#js-data-lga-ajax').find(':selected').val(),	
				  search: params.term // search term
				};
		  },
		  processResults: function (response) {
				$("#js-data-pu-ajax").val(null).trigger("change");
				return {
				  results: response
				};
			  },
		  cache: true
		  }
			  
		});
	});
	
	$(document).ready(function(){
		// CSRF Token
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
			
		$('#js-data-pu-ajax').select2({
		  dropdownParent: $('#js-data-pu-modal'),
		  selectOnClose: true,
		  ajax: {
			url: "/pollingunits/list",
			type: "post",
			dataType: 'json',
			data: function (params) {
				return {
				  _token: CSRF_TOKEN,	
				  lga_id: $('#js-data-lga-ajax').find(':selected').val(),	
				  wards_id: $('#js-data-wards-ajax').find(':selected').val(),	
				  search: params.term // search term
				};
		  },
		  processResults: function (response) {
				return {
				  results: response
				};
			  },
		  cache: true
		  }
			  
		});
	});