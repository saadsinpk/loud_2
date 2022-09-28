"use strict";

// Class definition
var KTModalRole = function() {
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
                        //modal.hide(); // Hide modal		
						$('#kt_modal_add_role').modal('hide');		
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
                        //modal.hide(); // Hide modal	
							$('#kt_modal_add_role').modal('hide');	
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
    var initroleList = function(from_date='',to_date='',searchword='') {

        // Set date data order
        datatable = $(table).DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: false,
            ajax: {
                url: url,
                data:{from_date:from_date,to_date:to_date,searchword:searchword}
            },
            columns: [
                {
                    data: 'no',
                    name: 'no',
                },
				{
                    data: 'name',
                    name: 'name',
                },
                /*{
                    data: 'permissionsname',
                    name: 'permissionsname',
                },*/
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
         
            handleDeleteRows();
			handleEditRows();
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
				  $('#permissions_view').html(current_row.permissionsname);
				 // $('#role_view').text(current_row.roles[0].name);
				  modalview.modal('show');
			});
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
	
    // Delete role
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

                // Get role name
                const roleName = parent.querySelectorAll('td')[1].innerText;
                const id = d.getAttribute('data-id'); 

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete " + roleName + "?",
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
                            url: `/roles/delete/${id}`,
                            method: "get",
                            dataType: "JSON",
                            success: function() {
                                jQuery("#loading").remove();
                                Swal.fire({
                                    text: "You have deleted " + roleName + "!.",
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
                            text: roleName + " was not deleted.",
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
        var from_date=$('#from_date').val();
        var to_date=$('#to_date').val();
        var searchword = $('#searchword').val();
            $('#kt_role_table').DataTable().destroy();
            initroleList(from_date,to_date,searchword);
    });


    return {
        // Public functions
        init: function() {
            modal = $('#kt_modal_add_role');
			modalview = $('#kt_modal_view_admin');
            table = document.querySelector('#kt_role_table');

            if (!table) {
                return;
            }

            form = document.querySelector('#kt_modal_add_role_form');
            cancelButton = form.querySelector('#kt_modal_add_role_cancel');
            closeButton = form.querySelector('#kt_modal_add_role_close');
            url = $("#kt_modal_add_role_form").attr("action");
            initroleList();
            closeForm();
        }
    };
}();

// On document ready
$(document).ready(function(){
    KTModalRole.init();
});