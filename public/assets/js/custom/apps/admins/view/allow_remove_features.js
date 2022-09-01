$(document).ready(function(){
	const adminFeaturesFormID = "form#allow_remove_admin_features_form"
    $(adminFeaturesFormID).on("submit", function(e){
        e.preventDefault()
        const url = $(this).attr("action")
        const method = $(this).attr("method")
        const formdata = $(this).serialize()


        Swal.fire({
			text: "Are you sure?",
			icon: "warning",
			showCancelButton: true,
			buttonsStyling: false,
			confirmButtonText: "Yes, save changes!",
			cancelButtonText: "No, cancel",
			customClass: {
				confirmButton: "btn fw-bold btn-success",
				cancelButton: "btn fw-bold btn-active-light-primary"
			}
		}).then(function (result) {
			if (result.value) {
				//trigger the action
				$.ajax({
		            url: url,
		            method: method,
		            data: formdata,
		            dataType: "JSON",
		            beforeSend:function(){
		                $(`${adminFeaturesFormID} span.indicator-progress`).show()
		                $(`${adminFeaturesFormID} button[type='submit']`).attr('disabled', true)
		            },
		            success: function(res) {
		                $(`${adminFeaturesFormID} span.indicator-progress`).hide()
		                $(`${adminFeaturesFormID} button[type='submit']`).attr('disabled', false)
		                
		                Swal.fire({
		                    title: "Success",
		                    text: res.msg,
		                    icon: "success",
		                    buttonsStyling: false,
		                    confirmButtonText: "Ok, got it!",
		                    customClass: {
		                        confirmButton: "btn btn-primary"
		                    }
		                })
		               
		            },
		            error: function (jqXHR, textStatus, errorThrown) {
		                let string_to_obj = JSON.parse(jqXHR.responseText)

		                if (jqXHR.status === 422) {
		                    
		                    Swal.fire({
		                        title: "Sorry",
		                        text: string_to_obj.msg,
		                        icon: "error",
		                        buttonsStyling: false,
		                        confirmButtonText: "Ok, got it!",
		                        customClass: {
		                            confirmButton: "btn btn-primary"
		                        }
		                    });

		                }else{
		                    Swal.fire({
		                        title: "Sorry",
		                        text: "Sorry, looks like there are some errors detected, please try again.",
		                        icon: "error",
		                        buttonsStyling: false,
		                        confirmButtonText: "Ok, got it!",
		                        customClass: {
		                            confirmButton: "btn btn-primary"
		                        }
		                    });
		                }

		            },
		            complete:function(){
		                $(`${adminFeaturesFormID} span.indicator-progress`).hide()
		                $(`${adminFeaturesFormID} button[type='submit']`).attr('disabled', false)
		            }
		        })
			}
		});

    })
})