function notEmpty(word) {
    variablesRefresh();
    if (word.replace(/ /g, '') !== ""){
        return true;
    }
    else return false;
}

function emailValid(email) {
    variablesRefresh();
    var dot = false;
    var emailSymbol = false
    var emailArray = email.split('') ;
    for (let i = 0; i < email.length; i++) {
        if(emailArray[i] === "." && dot === false){
            dot = true;
        }
        if (emailArray[i] === "@" && emailSymbol === false){
            emailSymbol = true;
        }
    }

    return dot && emailSymbol;
}

function message(message ,type = "error"){
    var box = $("<div></div>");
    box.addClass("clearfix message " + type);
    $("#message-box").append(box);

    box.append($("<img alt='icon' src='../icon/" + type + ".svg'>"));

    type = type === "error" ? "Chyba" : "Úspech";


    var div = $("<div></div>");
    box.append(div);
    div.append($("<h4>" + type+ "</h4>"));
    div.append($("<p>" + message + "</p>"));

    setTimeout(function () {
        box.slideUp(200);
        setTimeout(function () {
            box.remove();
        },200);
    },4000)
}