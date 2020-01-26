$(window).on('load', function() {
    $('.win').css("display" , "none");
    $('.img_click').click(function(e) {
        e.preventDefault();
        var link = $(this).attr('data-imglink');
        $('.pic').attr('src', link);
        console.log(link);
        $('.win').fadeIn();
        query = "path="+link.split("/")[3];
        console.log(query);
    });
    $('.close_win').click(function() {
        $(".win").fadeOut();
    });
    $(document).mouseup(function (event){
        var div = $('.frame');
        if (!div.is(event.target) && div.has(event.target).length === 0) {
            $(".win").fadeOut();
        };
    });
    // лисенер для кнопки отправки комментария
    $('.testim_button').click(function(e) {
        var name = $(".name").val();
        console.log(name);
        var text = $(".text").val();
        console.log(text);
        var query1 = "name=" + name +"&" + "text=" + text;
        console.log(query1);
        $.ajax ({
            type: "POST",
            url: "testimonial_proc.php",
            data: query1,
            success: function(msg) {
                let res = JSON.parse(msg);
                let str = "";
                let row = {};
                res.forEach(function(row) {
                    str += "<div><p class='t_bold'>" + row['name'] + " писал " + row['date'] + ":</p><p>" + row['text'] + "</p></div>";
                });
                $(".testim_rec").html(str);
            }
        });
    });
});
