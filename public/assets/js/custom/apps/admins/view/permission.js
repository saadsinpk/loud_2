"use strict";

// Class definition
var KTadminViewPermissionTable = function () {

    // Define shared variables
    var datatable;
    var table = document.querySelector('#kt_table_permission');
    var user_id;
    var submitButton;
    var cancelButton;
	var closeButton;
    var validator;
    var modal;
    var form;

    // Private functions
    var initPermissionView = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        const url =  `/admins/permission-list/${user_id}`;
        datatable = $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: url
            },
            columns: [{
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'action',
                    name: 'action',
                    class: 'text-end'
                },
            ],
            "info": false,
            'order': [],

            'columnDefs': [
                { orderable: false, targets: 1 }, // Disable ordering on column 6 (actions)
            ]
        });

        datatable.on('draw', function () {
            handleDeleteRows();
        });

    }

    // Delete admin
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-table-filter="delete_row"]');
        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function (e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // Get permission name
                const permissionName = parent.querySelectorAll('td')[0].innerText;
                const per_id = this.getAttribute("id");
                console.log(per_id);
                var formData = new FormData();

                formData.append("per_id", per_id);
                formData.append("user_id", user_id);
                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + permissionName + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        jQuery("body").append('<div id="loading" style="width: 100%;height: 100%;position: fixed;background: rgba(113, 148, 48, 0.3);top: 0;left: 0;z-index: 6000 !important;text-align: center;vertical-align: middle;padding: 9px 0;font-weight: bold;color: #fff;border-radius: 10px;font-size: 50px;"><div class="center_fix_verticle" style="position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);"><span class="show_message" style="font-size: 36px;color: green;">Loading...</span></div>    </div>');
                        $.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});
                        
                        $.ajax({
                            url:  `/admins/permission/revoke`,
                            method: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function() {
                                jQuery("#loading").remove();
                                Swal.fire({
                                    text: "You have deleted " + permissionName + "!.",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary",
                                    }
                                }).then(function () {
                                    // Remove current row
                                    datatable.row($(parent)).remove().draw();
                                });
                            }
                        }).catch(function(error){
                            jQuery("#loading").remove();
                            Swal.fire({
                                text: "Somethings went wrong. Try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                         });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: customerName + " was not deleted.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    // Init form inputs
    var handleGivePermissionForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
		validator = FormValidation.formValidation(
			form,
			{
				fields: {
                    'permission_name': {
						validators: {
							notEmpty: {
								message: 'Permmission name is required'
							}
						}
					},
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

		// Revalidate country field. For more info, plase visit the official plugin site: https://select2.org/
        $(form.querySelector('[name="permission_name"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validator.revalidateField('permission_name');
        });

		// Action buttons
		submitButton.addEventListener('click', function (e) {
			e.preventDefault();

			// Validate form before submit
			if (validator) {
				validator.validate().then(function (status) {

					var url = $("#kt_modal_add_permission_form").attr("action");

					var id = user_id
					var permission_name = $("select[name='permission_name']").val();

					var formData = new FormData();

					formData.append("id", id);
					formData.append("permission_name", permission_name);

					
					if (status == 'Valid') {
                        submitButton.setAttribute('data-kt-indicator', 'on');
                        submitButton.disabled = true;
						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});

						$.ajax({
							url:  url,
							method: "POST",
							data: formData,
							processData: false,
                            contentType: false,
							success: function() {
		
								setTimeout(function() {
                                    submitButton.removeAttribute('data-kt-indicator');
                                    submitButton.disabled = false;
									
									Swal.fire({
										text: "Form has been successfully submitted!",
										icon: "success",
										buttonsStyling: false,
										confirmButtonText: "Ok, got it!",
										customClass: {
											confirmButton: "btn btn-primary"
										}
									}).then(function (result) {
										if (result.isConfirmed) {
											// Hide modal
											modal.hide();

											$("select[name='permission_name']").val(null).trigger('change');
		
		
                                            $(table).DataTable().ajax.reload();

											// window.location = form.getAttribute("data-kt-redirect");
										}
									});							
								}, 2000); 
							}
						}).catch(function(error){
							if(error.status == 422) {
								Swal.fire({
									text: "Permission has already assinged.",
									icon: "error",
									buttonsStyling: false,
									confirmButtonText: "Ok, got it!",
									customClass: {
										confirmButton: "btn btn-primary"
									}
								});
							}else {
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
					}else {
						Swal.fire({
							text: "Sorry, looks like there are some errors detected, please try again.",
							icon: "error",
							buttonsStyling: false,
							confirmButtonText: "Ok, got it!",
							customClass: {
								confirmButton: "btn btn-primary"
							}
						});
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;
					}
				});
			}
		});

        cancelButton.addEventListener('click', function (e) {
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
            }).then(function (result) {
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

		closeButton.addEventListener('click', function(e){
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
            }).then(function (result) {
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
		})
    }

    // Public methods
    return {
        init: function () {
            if (!table) {
                return;
            }
            user_id = $("#admin_detail_id").val();
            // Elements

            modal = new bootstrap.Modal(document.querySelector('#kt_modal_add_permission'));

            form = document.querySelector('#kt_modal_add_permission_form');
            
            submitButton = form.querySelector('[data-kt-modal-action="submit"]');
            closeButton = form.querySelector('[data-kt-modal-action="close"]');
            cancelButton = form.querySelector('[data-kt-modal-action="cancel"]');

            initPermissionView();
            handleGivePermissionForm();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTadminViewPermissionTable.init();
});