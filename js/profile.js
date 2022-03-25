$(".follow").click(function (event) {
    event.preventDefault();

    follow($(this).attr("href"),$(this).children("img").attr("src"),$(this))
})

function follow(url,src, element){
    url = url.split('?');
    var req = $.ajax({
        url : url[0],
        type : 'POST',
        data : url[1] + "&status=" + (src === "../icon/plus.svg" ? "notfollowed" : "followed")
    });

    req.done(function (data) {
        console.log(data)
        if (data == "success"){
            if (element.children("img").attr("src") === "../icon/plus.svg"){
                element.children("img").attr("src","../icon/success.svg")
                message("Úspešne sledujete tohto používateľa", "success");
            }
            else {
                element.children("img").attr("src","../icon/plus.svg")
                message("Úž tohto používateľa nesledujete", "success");
            }
        }
        else {
            message("Niečo sa pokazilo");
        }
    })

}