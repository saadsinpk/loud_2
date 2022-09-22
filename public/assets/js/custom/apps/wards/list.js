"use strict";
// Class definition
var KTModalwards = function() {
    var cancelButton;
    var closeButton;
    var validator;
    var form;
    var modal;
	var modalview;
	var tableTr;
    var datatable;
    var table
    var url
    var formdata
    var ids = "";

    // Init form inputs

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
                       // modal.hide(); // Hide modal	
						$('#kt_modal_add_ward').modal('hide');						   
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
                       // modal.hide(); // Hide modal		
							$('#kt_modal_add_ward').modal('hide');
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
        // Private functions
        // alert(":asasda");
    var initwardList = function() {

        // Set date data order
        datatable = $(table).DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: false,
            ajax: {
                url: url
            },
            columns: [{
                    data: 'no',
                    name: 'no'
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    data: 'lga.name',
                    name: 'lga.name',
                },
                {
                    data: 'updated_at',
                    name: 'updated_at',
                },
                {
                    data: 'action',
                    name: 'action',
                    class: 'text-end',
                    orderable: false
                },
            ],
            "info": false,
            'order': [],
            'columnDefs': [
                { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox) 
            ]
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function() {
            ids = "";
            initToggleToolbar();
            handleDeleteRows();
			handleEditRows();
            toggleToolbars();
            handleClickabeRowtable();
        });
    }

    var handleClickabeRowtable = () => {
        tableTr = table.querySelectorAll('tbody tr'); //document.querySelector('tbody tr');
		tableTr.forEach(d => {
			d.addEventListener('click', function(e) {
                e.preventDefault();
				let current_row = datatable.row(this).data();
				  $('#name_view').text(current_row.name);
				  $('#email_view').text(current_row.email);
				  $('#role_view').text(current_row.roles[0].name);
				  modalview.modal('show');
			});
		});  
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[aria-controls="kt_admins_table"]');
        filterSearch.addEventListener('keyup', function(e) {
            datatable.search(e.target.value).draw();
        });
    }
	
	
    // Edit 
    var handleEditRows = () => {
        // Select all edit buttons
        const editButtons = table.querySelectorAll('[data-kt-table-filter="edit_row"]');
        editButtons.forEach(d => {
            // Edit button on click
            d.addEventListener('click', function(e) {
				e.stopPropagation();
                e.preventDefault();
				const url = d.getAttribute('href');
				window.open(url,"_self");
			});
		});
	}

    // Delete ward
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function(e) {
                e.preventDefault();
				e.stopPropagation();	
                // Select parent row
                const parent = e.target.closest('tr');

                // Get ward name
                const name = parent.querySelectorAll('td')[1].innerText;
                const id = d.getAttribute('data-id'); 

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + name + "?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function(result) {
                    if (result.value) {
                        jQuery("body").append('<div id="loading" style="width: 100%;height: 100%;position: fixed;background: rgba(113, 148, 48, 0.3);top: 0;left: 0;z-index: 6000 !important;text-align: center;vertical-align: middle;padding: 9px 0;font-weight: bold;color: #fff;border-radius: 10px;font-size: 50px;"><div class="center_fix_verticle" style="position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);"><span class="show_message" style="font-size: 36px;color: green;">Loading...</span></div>    </div>');
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url: `/wards/delete/${id}`,
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
                                }).then(function() {
                                    // Remove current row
                                    datatable.row($(parent)).remove().draw();
                                });
                            }
                        }).catch(function(error) {
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
    $('#filterthis').click(function(){
       
            $('#kt_ward_table').DataTable().destroy();
            initwardList();
        
    });
    // Init toggle toolbar
    var initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.querySelectorAll('[type="checkbox"]');
        // Select elements
        const deleteSelected = document.querySelector('[data-kt-ward-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function() {
                setTimeout(function() {
                    ids = "";
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function() {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            console.log(ids);
            Swal.fire({
                text: "Are you sure you want to delete selected ward?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {
                if (result.value) {
                    jQuery("body").append('<div id="loading" style="width: 100%;height: 100%;position: fixed;background: rgba(113, 148, 48, 0.3);top: 0;left: 0;z-index: 6000 !important;text-align: center;vertical-align: middle;padding: 9px 0;font-weight: bold;color: #fff;border-radius: 10px;font-size: 50px;"><div class="center_fix_verticle" style="position: fixed;top: 50%;left: 50%;transform: translate(-50%, -50%);"><span class="show_message" style="font-size: 36px;color: green;">Loading...</span></div>    </div>');
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: `/wards/delete-rows`,
                        data: { ids: ids.substr(1) },
                        method: "post",
                        dataType: "JSON",
                        success: function() {
                            jQuery("#loading").remove();
                            Swal.fire({
                                text: "You have deleted all selected ward!.",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary",
                                }
                            }).then(function() {
                                // Remove all selected ward
                                checkboxes.forEach(c => {
                                    if (c.checked) {
                                        datatable.row($(c.closest('tbody tr'))).remove().draw();
                                    }
                                });

                                // Remove header checked box
                                const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                                headerCheckbox.checked = false;
                            });
                        }
                    }).catch(function(error) {
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
                        text: "Selected ward was not deleted.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        });
    }

    // Toggle toolbars
    const toggleToolbars = () => {
        // Define variables
        const toolbarBase = document.querySelector('[data-kt-ward-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-ward-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-ward-table-select="selected_count"]');

        // Select refreshed checkbox DOM elements 
        const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');
        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                ids += "," + c.parentNode.children[1].value
                console.log(ids);
                checkedState = true;
                count++;
            }
        });
        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    return {
        // Public functions
        init: function() {
            modal = new bootstrap.Modal(document.querySelector('#kt_modal_add_ward'));
			modalview = $('#kt_modal_view_admin');
            table = document.querySelector('#kt_wards_table');

            if (!table) {
                return;
            }

            form = document.querySelector('#kt_modal_add_ward_form');
            cancelButton = form.querySelector('#kt_modal_add_ward_cancel');
            closeButton = form.querySelector('#kt_modal_add_ward_close');
            url = $("#kt_modal_add_ward_form").attr("action");
            initwardList();
           // initToggleToolbar();
            handleSearchDatatable();
            closeForm();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTModalwards.init();
});