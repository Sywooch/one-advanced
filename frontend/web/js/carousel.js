(function() {

    $(document).ready(function() {

        var options = {
            ovalWidth: 400,
            ovalHeight: 0,
            offsetX: 0,
            offsetY: 230,
            angle: 0,
            activeItem: 3,
            duration: 350,
            className: 'item'
        }

        var carousel = $('.carousel-3d').CircularCarousel(options);

        ///* Fires when an item is about to start it's activate animation */
        //carousel.on('itemBeforeActive', function(e, item) {
        //    $(item).css('box-shadow', '0 0 20px blue');
        //});
        //
        ///* Fires after an item finishes it's activate animation */
        //carousel.on('itemActive', function(e, item) {
        //    $(item).css('box-shadow', '0 0 20px green');
        //});
        //
        ///* Fires when an active item starts it's de-activate animation */
        //carousel.on('itemBeforeDeactivate', function(e, item) {
        //    $(item).css('box-shadow', '0 0 20px yellow');
        //})
        //
        ///* Fires after an active item has finished it's de-activate animation */
        //carousel.on('itemAfterDeactivate', function(e, item) {
        //    $(item).css('box-shadow', '');
        //})


        /* Previous button */
        $('.controls .previous').click(function(e) {
            carousel.cycleActive('previous');
            e.preventDefault();
        });

        /* Next button */
        $('.controls .next').click(function(e) {
            carousel.cycleActive('next');
            e.preventDefault();
        });

        /* Manaully click an item anywhere in the carousel */
        //$('.carousel .item').click(function(e) {
        //    var index = $(this).index('li');
        //    carousel.cycleActiveTo(index);
        //    e.preventDefault();
        //});

        /* Manaully click an item anywhere in the carousel */
        //$('.carousel .item').click(function(e) {
        //    console.log($(e).data('link'));
        //    //window.location();
        //    //var index = $(this).index('li');
        //    //carousel.cycleActiveTo(index);
        //    //e.preventDefault();
        //});

    });

})();