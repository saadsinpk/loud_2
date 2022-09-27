"use strict";

// Class definition
var KTSigninGeneral = function() {
    // Elements
    var form;
    var submitButton;
    var passwordInput;
    var emailInput;
    var validator;

    // Handle form
    var handleForm = function(e) {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validator = FormValidation.formValidation(
            form, {
                fields: {
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'Email address is required'
                            },
                            emailAddress: {
                                message: 'The value is not a valid email address'
                            }
                        }
                    },
                    'password': {
                        validators: {
                            notEmpty: {
                                message: 'The password is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    /*bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row'
                    })*/
                }
            }
        );

        // Handle form submit
        submitButton.addEventListener('click', function(e) {
            var url = $("#kt_sign_in_form").attr("action");
            var formdata = $('#kt_sign_in_form').serialize();
            // console.log(formdata);
            // Prevent button default action
            e.preventDefault();
            // Validate form
            validator.validate().then(function(status) {
                submitButton.setAttribute('data-kt-indicator', 'on');
                submitButton.disabled = true;
                if (status == 'Valid') {

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: url,
                        method: "POST",
                        data: formdata,
                        dataType: "JSON",
                        success: function(res) {
                            
                            if (res == "200") {
                                // Show loading indication

                                // Disable button to avoid multiple click 


                                // Simulate ajax request
                                setTimeout(function() {
                                    // Hide loading indication
                                    submitButton.removeAttribute('data-kt-indicator');

                                    // Enable button
                                    submitButton.disabled = false;

                                    // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                    location.href = "/admin/dashboard";
                                }, 2000);
                            }
                        },
                    }).catch(function(error) {
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
                        if (error.status == 422) {
                            Swal.fire({
                                text: "These credentials do not match our records.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function() {
                                //location.href = "/";
                            });
                        } else if (error.status == 401) {
                            Swal.fire({
                                text: "You do not have the required authorization.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function() {
                                //location.href = "/";
                            });
                        } else {
                            Swal.fire({
                                text: "Somethings went wrong.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function() {
                                //location.href = "/";
                            });
                        }
                    });

                } else {
                    submitButton.removeAttribute('data-kt-indicator');
                    submitButton.disabled = false;
                    // Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });
		
		// Handle form submit
        emailInput.addEventListener('keyup', function(event) {
			 if (event.keyCode  === 13) { 
				submitButton.click();
			 }
		});
		
        // Handle form submit
        passwordInput.addEventListener('keyup', function(event) {
			 if (event.keyCode  === 13) {
				submitButton.click();
			 }
		});
    }

    // Public functions
    return {
        // Initialization
        init: function() {
            form = document.querySelector('#kt_sign_in_form');
            submitButton = document.querySelector('#kt_sign_in_submit');
            emailInput = document.querySelector('#emailInput');
            passwordInput = document.querySelector('#passwordInput');
            handleForm();
        }
    };
}();

// On document ready
$(document).ready(function(){
    KTSigninGeneral.init();
});