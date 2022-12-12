// js code will be written here

const clearErrorMessage = (id)=>{
    // Removing the laravel error messages once the text field is clicked
    $(id).html('');
}

const createAuthor = ()=>{
    let authorName = $("#authorName").val();
    let authorPhoto = $("#authorPhoto").val();

    console.log(authorPhoto);
    $.ajax({
        type : 'POST',
        url : "http://127.0.0.1:8000/api/addAuthor",
        dataType: 'JSON',
        headers: {
            'X-CSRF-TOKEN' : $('input[name="_token"]').val()
        },
        data : {
            authorName: authorName,
            authorPhoto: authorPhoto
        },
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
    });
}
