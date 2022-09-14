"use strict";

// Class definition
var KTModalUpdatepoliticalpartyagent = function() {
    var element;
    var submitButton;
    var cancelButton;
    var closeButton;
    var form;
    var modal;
    var validator;

    // Init form inputs
    var initForm = function() {

        validator = FormValidation.formValidation(
            form, {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'political party agent name is required'
                            }
                        }
                    },
                    // 'email': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'politicalpartyagent email is required'
                    //         },
                    //         emailAddress: {
                    //             message: 'The value is not a valid email address'
                    //         },
                    //     }
                    // }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Action buttons
        submitButton.addEventListener('click', function(e) {
            // Prevent default button action
            e.preventDefault();

            if (validator) {
                validator.validate().then(function(status='validate') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;

                    var url = $("#kt_modal_update_politicalpartyagent_form").attr("action");
					var formData = new FormData();
                    
                    var id = $("#politicalpartyagent_id").val();
                    var lga_id = $("#js-data-lga-ajax").val();
                    var ward_id = $("#js-data-wards-ajax").val();
                    var pu_id = $("#js-data-pu-ajax").val();
                    var name = $("#name").val();
                    var political_party = $("#political_party").val();
                    var agent_picture = $("#agent_picture")[0].files[0];
                    var designation = $("#designation").val();
                    var home_address = $("#home_address").val();
                    var mobile = $("#mobile").val();
                    var extra_mobile = $("#extra_mobile").val();
                    var signature_agent = $("#signature_agent").val();
                    var signature_auth_party_officials = $("#signature_auth_party_officials").val();
                    var name_party_chairman = $("#name_party_chairman").val();
                    var signature_party_chairman = $("#signature_party_chairman").val();
                    var name_electoral_officer = $("#name_electoral_officer").val();
                    var signature_electoral_officer = $("#signature_electoral_officer").val();
					
                    formData.append("id", id);
                    formData.append("name", name);
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

                    /*if (avatar != undefined) {
                        formData.append("avatar", avatar);
                    }*/

                    if (status == 'Valid') {
                       

                        $.ajax({
                            url: url,
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function() {
                                // Simulate form submission
                                setTimeout(function() {
                                    // Simulate form submission

                                    // Show popup confirmation 
                                    Swal.fire({
                                        text: "Form has been successfully submitted!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    }).then(function(result) {
                                        submitButton.removeAttribute('data-kt-indicator');
                                        submitButton.disabled = false;
                                        form.reset(); // Reset form	
                                        if (result.isConfirmed) {
                                            modal.hide();
                                            window.location.reload();
                                        }
                                    });

                                    //form.submit(); // Submit form
                                }, 2000);
                            }
                        }).catch(function(error) {
                            console.log(error);
                                Swal.fire({
                                    text: "Somethings went wrong. Try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            
                            submitButton.removeAttribute('data-kt-indicator');
                            submitButton.disabled = false;
                        });
                    }
                })
            }
        });

        cancelButton.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function(result) {
                if (result.value) {
                    form.reset(); // Reset form	
                    modal.hide(); // Hide modal				
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });

        closeButton.addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function(result) {
                if (result.value) {
                    form.reset(); // Reset form	
                    modal.hide(); // Hide modal				
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Your form has not been cancelled!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    }

    return {
        // Public functions
        init: function() {
            // Elements
            element = document.querySelector('#kt_modal_update_politicalpartyagent');
            modal = new bootstrap.Modal(element);

            form = element.querySelector('#kt_modal_update_politicalpartyagent_form');
            submitButton = form.querySelector('#kt_modal_update_politicalpartyagent_submit');
            cancelButton = form.querySelector('#kt_modal_update_politicalpartyagent_cancel');
            closeButton = element.querySelector('#kt_modal_update_politicalpartyagent_close');

            initForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTModalUpdatepoliticalpartyagent.init();
});