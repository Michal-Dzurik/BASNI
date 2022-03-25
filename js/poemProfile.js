try {
    var removeButton = $("#remove");
}catch (e) {
    console.log("Neni tvoje");
}

removeButton.click(function (event) {
    event.preventDefault();

    if (confirm("Ste si istý, že chcete túto báseň odstrániť?")){
        remove();
    }
})

function remove(){

    var req = $.ajax({
        url : removeButton.attr("href"),
        type : 'GET'
    });

    req.done(function (data) {
        if (data === "success"){
            message("Úspešne sme vymazali túto báseň", "success");
        }
        else{
            message("Nepodarilo sa nám vymazať báseň");
        }

    })

}

var addCommentForm = $("#comment-form");

$("#submit").click(function (event) {
    event.preventDefault();
    var text = $("#newComment").val();
    if (checkComment(text)){
        addComment();
    }


})

function checkComment(text) {
    text.trim();

    if (text === ""){
        return false;
    }
    else return true;
}

function addComment(){

    var req = $.ajax({
        url : addCommentForm.attr("action"),
        data: addCommentForm.serialize(),
        type : 'GET'
    });


    req.done(function (data) {
        console.log(data);
        if (data === "success"){
            message("Úspešne sme pridali Váš komentár", "success");

            newComment();
        }
        else{
            message("Nepodarilo sa nám pridať Váš komentár");
        }

    })

}

function newComment() {
    var authorId = $('#author_id').val();
    var name = $('#name').val();
    var text = $("#newComment").val();

    var div = $("<div></div>");
    div.addClass("comment");
    div.html("<h4><a href=\"../profile/index.php?id=" + authorId + "\">" + name + "</a></h4>\n" + "<p>" + text + "</p>");

    $("#comments").append(div);
    div.hide().slideDown(200);

    $("#newComment").val("");

}