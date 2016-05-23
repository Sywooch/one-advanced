$('body').on('click', '#add-players', function () {
    //$('#add-players').click(function () {
        var players = $('#players-home').yiiGridView('getSelectedRows');

        if (players.length>0) {
            var game_id = $(this).attr('data-game');
            var team_id = $(this).attr('data-team');
            //console.log(keys);
            $.post('/admin/games/add-players', {
                players: players,
                game_id: game_id,
                team_id: team_id
            }).done(function () {
                //$.pjax.reload({container: "#players-home-pjax"});
                $.pjax.reload({container: "#game-home-players-pjax"});
            });
        }
    //});
});

function deletePlayer(id) { //author Alex P.
    var yes = confirm("Хотите удалить?");
    if( yes ) {
        $.ajax({
            method: "get",
            url: "/admin/games-players/delete-pjax",
            data : { 'id' : id }
        }).done(function (data) {
            //if(data=='true') {
                //$("#order_"+order_id).slideUp(500);
                $('tr[data-key="'+id+'"]').fadeOut();
            //}
        });
    }
}
//$('body').on('click', '#add-players', function () {
//    var players = $('#players-home').yiiGridView('getSelectedRows');
//
//    console.log(players);
//});