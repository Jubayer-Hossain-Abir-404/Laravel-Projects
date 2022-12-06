// js code will be written here
const createAuthor = ()=>{
    var authorName = $("#authorName").val();
    var authorPhoto = $("#authorPhoto").val();

    $.ajax({
        type : 'POST',
        url : "http://127.0.0.1:8000/api/addAuthor",
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
            alert(JSON.stringify(data));
        }
    });
}
