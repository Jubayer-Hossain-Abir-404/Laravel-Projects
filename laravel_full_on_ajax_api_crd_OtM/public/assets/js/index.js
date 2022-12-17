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
                // alert(data.responseJSON);
                //
                // foreach()
                console.log(data);
            },

            error: function (data){
                let errors = data.responseJSON;
                console.log(errors);
                clearErrorMessage('#authorName_error');
                clearErrorMessage('#authorPhoto_error');
                $.each(errors, function( key, value ) {
                    $("#" + key + "_error").append('<div class="alert alert-danger">'+ value[0] +'</div');
                });
            }
        })
    });

});


