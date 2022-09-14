"use strict";

// Class definition
var KTModalUpdateward = function() {
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
                                message: 'ward name is required'
                            }
                        }
                    },
                    // 'email': {
                    //     validators: {
                    //         notEmpty: {
                    //             message: 'ward email is required'
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

                    var url = $("#kt_modal_update_ward_form").attr("action");
                    var formData = new FormData();

                    var id = $("#ward_id").val();
                    // var avatar = $("#avatar")[0].files[0];
                    var name = $("#name").val();
                    // var email = $("#email").val();
                    var lga_id = $("#lga_id").val();
                    formData.append("id", id);
                    formData.append("name", name);
                    formData.append("lga_id", lga_id);
                    // formData.append("email", email);

                    /*if (avatar != undefined) {
                        formData.append("avatar", avatar);
                    }*/

                    if (status == 'Valid') {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

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
                            if (error.status == 422) {
                                Swal.fire({
                                    text: "The email has already been taken.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            } else {
                                Swal.fire({
                                    text: "Somethings went wrong. Try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
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
            element = document.querySelector('#kt_modal_update_ward');
            modal = new bootstrap.Modal(element);

            form = element.querySelector('#kt_modal_update_ward_form');
            submitButton = form.querySelector('#kt_modal_update_ward_submit');
            cancelButton = form.querySelector('#kt_modal_update_ward_cancel');
            closeButton = element.querySelector('#kt_modal_update_ward_close');

            initForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTModalUpdateward.init();
});