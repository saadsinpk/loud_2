$(document).ready(function(){
    const politicalpartyagentFormId = "form#kt_modal_add_politicalpartyagent_form"
    $(politicalpartyagentFormId).on("submit", function(e){
        e.preventDefault()
        const url = $(this).attr("action")
        const method = $(this).attr("method")
        //const formdata = $(this).serialize()

        var formData = new FormData();
		var lga_id = $("#js-data-lga-ajax").val();
        var ward_id = $("#js-data-wards-ajax").val();
        var pu_id = $("#js-data-pu-ajax").val();
		var agent_picture = $("#agent_picture")[0].files[0];
        var first_name = $("#first_name").val();
        var middle_name = $("#middle_name").val();
        var last_name = $("#last_name").val();
        var political_party = $("#political_party").val();
        var designation = $("#designation").val();
        var home_address = $("#home_address").val();
        var mobile = $("#mobile").val();
        var extra_mobile = $("#extra_mobile").val();
		
        var latitude = $("#latitude").val();
        var longitude = $("#longitude").val();
        
		
		var signature_agent = 0;
		if($("#signature_agent").is(':checked')){
			signature_agent = 1;
		}
					
		var signature_auth_party_officials = 0;
		if($("#signature_auth_party_officials").is(':checked')){
			signature_auth_party_officials = 1;
		}
					
        var name_party_chairman = $("#name_party_chairman").val();
		var signature_party_chairman = 0;
		if($("#signature_party_chairman").is(':checked')){
				signature_party_chairman = 1;
		}
        var name_electoral_officer = $("#name_electoral_officer").val();
		var signature_electoral_officer = 0;
		if($("#signature_electoral_officer").is(':checked')){
			signature_electoral_officer = 1;
		}
					
                 
        formData.append("latitude", latitude);
        formData.append("longitude", longitude);
        formData.append("first_name", first_name);
        formData.append("middle_name", middle_name);
        formData.append("last_name", last_name);
        formData.append("political_party", political_party);
        formData.append("agent_picture", agent_picture);
        formData.append("designation", designation);
        formData.append("home_address", home_address);
        formData.append("mobile", mobile);
        formData.append("extra_mobile", extra_mobile);
        formData.append("signature_agent", signature_agent);
        formData.append("signature_auth_party_officials", signature_auth_party_officials);
        formData.append("name_party_chairman", name_party_chairman);
        formData.append("signature_party_chairman", signature_party_chairman);
        formData.append("name_electoral_officer", name_electoral_officer);
        formData.append("signature_electoral_officer", signature_electoral_officer);
        formData.append("wards_id", ward_id);
        formData.append("lga_id", lga_id);
        formData.append("polling_unit_id", pu_id);
		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');			
		formData.append("_token", CSRF_TOKEN);			
        // console.log(formdata);
        $.ajax({
             url: url,
             method: "POST",
             data: formData,
             processData: false,
             contentType: false,
            beforeSend:function(){
                $(`${politicalpartyagentFormId} span.indicator-progress`).show()
                $(`${politicalpartyagentFormId} button[type='submit']`).attr('disabled', true)
            },
            success: function(res) {
                $(`${politicalpartyagentFormId} span.indicator-progress`).hide()
                $(`${politicalpartyagentFormId} button[type='submit']`).attr('disabled', false)
                
                Swal.fire({
                    title: "Success",
                    text: res.msg,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {
                    window.location.reload(true)
                });
               
            },
            error: function (jqXHR, textStatus, errorThrown) {
                let string_to_obj = JSON.parse(jqXHR.responseText);
				console.log(string_to_obj);
                    Swal.fire({
                        title: "Sorry",
                        text: string_to_obj.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

            },
            complete:function(){
                $(`${politicalpartyagentFormId} span.indicator-progress`).hide()
                $(`${politicalpartyagentFormId} button[type='submit']`).attr('disabled', false)
            }
        })

    })
})