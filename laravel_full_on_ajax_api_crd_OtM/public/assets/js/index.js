// js code will be written here

const clearErrorMessage = (id)=>{
    // Removing the laravel error messages once the text field is clicked
    $(id).html('');
}


$(document).ready(function(){
    $('#authorForm').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"http://127.0.0.1:8000/api/addAuthor",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            headers: {
                'X-CSRF-TOKEN' : $('input[name="_token"]').val()
            },
            contentType: false,
            cache: false,
            processData: false,
            success: function(data){
                $("#authorSuccessMessage").html('<div class="mt-2 alert alert-success">'+ data.message +'</div>');
                $("#authorName").val('');
                $("#authorPhoto").val('');
                clearErrorMessage('#authorName_error');
                clearErrorMessage('#authorPhoto_error');
            },

            error: function (data){
                let errors = data.responseJSON;
                // console.log(errors);
                clearErrorMessage('#authorName_error');
                clearErrorMessage('#authorPhoto_error');
                $("#authorSuccessMessage").html('');
                $.each(errors, function( key, value ) {
                    $("#" + key + "_error").html('<div class="alert alert-danger">'+ value[0] +'</div>');
                });
            }
        })
    });

});


