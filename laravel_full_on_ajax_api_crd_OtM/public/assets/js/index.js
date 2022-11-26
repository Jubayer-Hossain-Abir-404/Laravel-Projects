const createAuthor = ()=>{
    var authorName = $("#authorName").val();
    var authorPhoto = $("#aauthorPhoto").val();

    $.ajax({
        type : 'POST',
        url : "/api/addAuthor",
        headers: {
            'X-CSRF-TOKEN' : $('input[name="_token"]').val()
        },
        data : {
            authorName: authorName,
            authorPhoto: authorPhoto
        },
        success: function(data){
            alert(data);
        }


    });
}
