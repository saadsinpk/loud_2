var KTObj = function () {
     // Define shared variables
     var datatable;
     var user_id;
     var table = document.querySelector('#kt_table_site');
     var cancelButton;
     var closeButton;
     var validator;
     var modal;
     var form;
     var closeForm = () => {
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
        })
    }

    const dataTable = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        const url =  `/admins/site-list/${user_id}`;
        datatable = $(table).DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: url
            },
            columns: [{
                    data: 'site_name',
                    name: 'site_name',
                },
                {
                    data: 'domain',
                    name: 'domain',
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
            addsiteButtonToggle();

        });

    }


	const handleDeleteRows = () => {
		// Select all delete buttons
		var removeSiteButton = table.querySelectorAll('[data-kt-table-filter="remove_site"]');
		removeSiteButton.forEach(d => {
			// Delete button on click
			d.addEventListener('click', function (e) {
				e.preventDefault();

				// Select parent row
				const parent = e.target.closest('tr');

				// Get admin name
				const name = parent.querySelectorAll('td')[0].innerText;
                const siteID = d.getAttribute('data_site_id')
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
						$.ajaxSetup({
							headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});

						$.ajax({
							url:  `/admins/remove-site/${user_id}/${siteID}`,
							method: "GET",
							dataType: "JSON",
							success: function(response) {
								Swal.fire({
                                    title:"Success",
									text: response.msg,
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

						})
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

    const addsiteButtonToggle = () => {
        // console.log($("#kt_table_site tbody").children())
        if($("#kt_table_site tbody").children().length > 0) {
            const button = document.querySelector('[data-bs-target="#kt_modal_add_site"]');
            console.log(button);
        }else {
            button.style.display = "block";
        }
    }

    return {
        init: function () {
            if (!table) {
                return;
            }

            user_id = $("#admin_detail_id").val();

            modal = new bootstrap.Modal(document.querySelector('#kt_modal_add_site'));
            form = document.querySelector('#kt_modal_add_site form');
            closeButton = form.querySelector('[data-kt-modal-action="close"]');
            cancelButton = form.querySelector('[data-kt-modal-action="cancel"]');

            dataTable();
            closeForm();
        }
    }
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTObj.init();
});



//on ready document
$(document).ready(function(){
    const addSitesFormId = "form#add_sites_to_admin_form"
    $(addSitesFormId).on("submit", function(e){
        e.preventDefault()
        const url = $(this).attr("action")
        const method = $(this).attr("method")
        const formdata = $(this).serialize()

        $.ajax({
            url: url,
            method: method,
            data: formdata,
            dataType: "JSON",
            beforeSend:function(){
                $(`${addSitesFormId} span.indicator-progress`).show()
                $(`${addSitesFormId} button[type='submit']`).attr('disabled', true)
            },
            success: function(res) {
                $(`${addSitesFormId} span.indicator-progress`).hide()
                $(`${addSitesFormId} button[type='submit']`).attr('disabled', false)
                
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
                $(`${addSitesFormId} span.indicator-progress`).hide()
                $(`${addSitesFormId} button[type='submit']`).attr('disabled', false)
            }
        })

    })
})