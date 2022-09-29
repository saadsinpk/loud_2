class ContentListLayerHandler{
	
	static matrix_add_row(a){
		const h = $(a).parent().prev().find('tbody tr').eq(-1);
		$(h).clone().insertAfter($(h));
	}

	static matrix_remove_column(a){
		if($('#whatMain table thead th').length == 2){
			console.log(`The last column can't be delete`)
			return//can't delete last one...
		}
		const class_name = $(a).parent().attr('data-matrix_column');
		//remove target th
		$(a).parent().remove();
		//remove target td
		$('#whatMain table tbody td.'+class_name).remove()
		
	}
	static matrix_remove_row(a){
		if($('#whatMain table tbody tr').length == 1){
			console.log(`The last row can't be delete`)
			return
		}
		$(a).parent().parent().remove();
	}

}