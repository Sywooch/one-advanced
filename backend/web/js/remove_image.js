function ImageRemove(id) {

    var yes = confirm("Delete this Image?");
    if(yes) {
        $.ajax({
            method: "GET",
            url: "/admin/image/api-image-delete",
            data : {'image_id' : id}
        }).done(function(data) {
            $("#image_"+id).html('<p class="bg-success">'+data+'</p>').fadeOut(3000);
            //alert(data);
        });

    }
}