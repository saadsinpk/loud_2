$(document).ready(function(){
    const postFormId = "form#kt_modal_add_post_form"
    $(postFormId).on("submit", function(e){
        e.preventDefault()
        const url = $(this).attr("action")
        const method = $(this).attr("method")
        const formdata = $(this).serialize()
        $.ajax({
            url: url,
            method: method,
            data: new FormData(this),
            dataType: "JSON",
            processData: false,
            contentType: false,
            beforeSend:function(){
                $(`${postFormId} span.indicator-progress`).show()
                $(`${postFormId} button[type='submit']`).attr('disabled', true)
            },
            success: function(res) {

                $(`${postFormId} span.indicator-progress`).hide()
                $(`${postFormId} button[type='submit']`).attr('disabled', false)
                
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
                $(`${postFormId} span.indicator-progress`).hide()
                $(`${postFormId} button[type='submit']`).attr('disabled', false)
            }
        })

    })
})