var KTWareObj = function () {
     // Define shared variables
     var datatable;
     var user_id;
     var table = document.querySelector('#kt_table_admins_warehouse');
     var submitButton;
     var cancelButton;
     var closeButton;
     var validator;
     var modal;
     var form;
     
    const dataTable = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        const url =  `/admins/warehouse-list/${user_id}`;
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
                    data: 'location',
                    name: 'location',
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
                { orderable: false, targets: 2 }, // Disable ordering on column 6 (actions)
            ]
        });

        datatable.on('draw', function () {
            handleDeleteRows();
            addButtonToggle();

        });

    }

	const handleForm = () => {

        validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'warehouse': {
                        validators: {
                            notEmpty: {
                                message: 'Warehouse is required'
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

        $(form.querySelector('[name="warehouse"]')).on('change', function() {
            // Revalidate the field when an option is chosen
            validator.revalidateField('warehouse');
        });


        // Action buttons
        submitButton.addEventListener('click', function (e) {			
            e.preventDefault();

            // Validate form before submit
            if (validator) {
                validator.validate().then(function (status) {

                    if (status == 'Valid') {
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;
                    formdata = $('#kt_modal_add_warehouse form').serialize();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url:  url,
                            method: "POST",
                            data: formdata,
                            dataType: "JSON",
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
        
        
                                            // Redirect to Admins list page
                                            $(table).DataTable().ajax.reload();
                                        }
                                    });							
                                }, 2000); 
                            }
                        }).catch(function(error){
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

	const handleDeleteRows = () => {
		// Select all delete buttons
		var removeButton = table.querySelectorAll('[data-kt-table-filter="remove_site"]');
		removeButton.forEach(d => {
			// Delete button on click
			d.addEventListener('click', function (e) {
				e.preventDefault();

				// Select parent row
				const parent = e.target.closest('tr');

				// Get admin name
				const name = parent.querySelectorAll('td')[0].innerText;

				// SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
				Swal.fire({
					text: "Are you sure you want to Remove " + name + "?",
					icon: "warning",
					showCancelButton: true,
					buttonsStyling: false,
					confirmButtonText: "Yes, remove!",
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
							url:  `/admins/remove-warehouse/${user_id}`,
							method: "get",
							dataType: "JSON",
							success: function() {
                                jQuery("#loading").remove();
								Swal.fire({
									text: "You have deleted " + name + "!.",
									icon: "success",
									buttonsStyling: false,
									confirmButtonText: "Ok, got it!",
									customClass: {
										confirmButton: "btn fw-bold btn-primary",
									}
								}).then(function () {
									 // Remove current row
									 $(table).DataTable().ajax.reload();
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
							text: name + " was not deleted.",
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

    const addButtonToggle = () => {
        // if($("#kt_table_site tbody").children().length > 0) {
        //     const button = document.querySelector('[data-bs-target="#kt_modal_add_warehouse"]');
        //     console.log(button);
        //     button.style.display = "none";
        // }
    }

    return {
        init: function () {
            if (!table) {
                return;
            }
            user_id = $("#admin_detail_id").val();

            modal = new bootstrap.Modal(document.querySelector('#kt_modal_add_warehouse'));
            form = document.querySelector('#kt_modal_add_warehouse form');
            submitButton = form.querySelector('[data-kt-modal-action="submit"]');
            closeButton = form.querySelector('[data-kt-modal-action="close"]');
            cancelButton = form.querySelector('[data-kt-modal-action="cancel"]');

			url = form.getAttribute("action");
            dataTable();
            handleForm();            
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTWareObj.init();
});