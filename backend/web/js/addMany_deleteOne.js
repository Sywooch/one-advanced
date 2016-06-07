$('body').on('click', '.perform-action', function () {
    //$('#add-players').click(function () {
    var gridId = $(this).data('grid-id');
    var idArray = $('#'+gridId).yiiGridView('getSelectedRows');

    if (idArray.length>0) {

        var data = $(this).data();
        data['array'] = idArray;

        $.post('add', {
            data: data
        }).done(function () {
            $.pjax.reload({container: "#sub-"+gridId+"-pjax"});
        });
    }
    //});
});

function deletePlayer(id,url) {
    var yes = confirm("Хотите удалить?");
    if( yes ) {
        $.ajax({
            method: "get",
            url: url,
            data : { 'id' : id }
        }).done(function (data) {
            //if(data=='true') {
                //$("#order_"+order_id).slideUp(500);
                $('tr[data-key="'+id+'"]').fadeOut();
            //}
        });
    }
}