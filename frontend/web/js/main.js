/*
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
$(function () {
    var $cont = $(".twitter-container"),
        prd = setInterval(function () {
            if ($cont.find("> iframe").contents().find(".twitter-timeline").length > 0) {
                var $body = $cont.find("> iframe").contents().find("body");
                clearInterval(prd);
                $body.attr("id", "twitterStyled")
                    .append($("#twitterStyle"));
            }
        }, 100);
});*/
