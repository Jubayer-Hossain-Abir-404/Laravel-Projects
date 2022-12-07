// js code will be written here
const createAuthor = ()=>{
    var authorName = $("#authorName").val();
    var authorPhoto = $("#authorPhoto").val();

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
            // console.log(data);
        },

        error: function (data){
            var errors = data.responseJSON;
            console.log(errors);
            $.each(errors, function( key, value ) {
                $('#errorAuthorName').append('<div class="alert alert-danger">'+ value[0] +'</div');
            });
            // $.each(data, function(i, message) {
            //     // console.log(message);
            //     console.log(message.authorName);
            //     // console.log(message);
            //
            //     $('#errorAuthorName').append('<div class="alert alert-danger">'+message.authorName+'</div');
            // });
            // // alert(JSON.stringify(data));
        }
    });
}
