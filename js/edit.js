var textarea = document.getElementById('text');

var text = "" ;
var controls = [];
var position;
var indexOfRowOn = 0;

// on start

$( document ).ready(function() {
    text = textarea.value.split("\n");

    for (let i = 0; i < text.length; i++) {
        controls.push(createNewRowControls());
    }

    for (let i = 0; i < text.length; i++) {
        controls[i].textContent = syllable(text[i]);
    }

});


// on event in textarea
textarea.addEventListener('keyup', function (event) {
    textarea.style.height = "auto";
    textarea.style.height = textarea.scrollHeight + 'px'
    indexOfRowOn = textarea.value.substr(0, textarea.selectionStart).split("\n").length -1;

    text = textarea.value.split("\n");

    var controlsLength = controls.length ;
    var rowCount = text.length;
    var count = 0;
    if (controlsLength < rowCount){
        count = rowCount - controlsLength;
        for (let i = 0; i < count; i++) {
            controls.push(createNewRowControls());
        }

    }
    else if (controlsLength > rowCount ){
        count = controlsLength - rowCount;
        for (let i = 1; i <= count; i++) {
            controls[controlsLength - i ].remove();
        }
        controls.splice(controlsLength - count,count);

    }

    for (let i = 0; i < rowCount; i++) {
        if (event.keyCode === 32 || event.key === "space"){
            controls[i].textContent = syllable(text[i]);
        }
        else if (event.keyCode === 8 || event.key === "backspace"){
            controls[i].textContent = syllable(text[i]);
            //letterCount[i].textContent = countOfLetters(text.slice(0, -1));
        }
        else if (event.keyCode === 13 || event.key === "enter"){
            controls[i].textContent = syllable(text[i]);
        }
        else{
            //letterCount[i].textContent = countOfLetters(text);
        }
    }

});

var controlPanel = document.getElementById("syllable-handler");

function createNewRowControls() {
    var el = document.createElement("div");
    el.classList.add("control");
    el.textContent = "0";

    controlPanel.appendChild(el);
    return el;
}

shortcut.add("Ctrl+S",function() {
    save();
});

$("#save").click(function (event) {
    event.preventDefault();
    save();
})

$("#save-public").click(function (event) {
    event.preventDefault();
    save(true);
});

shortcut.add("Ctrl+Shift+S",function() {
    save(true);
});


var poemForm = $('#poem-form');

function save(statement = false) {
    var data = statement ? poemForm.serialize() + "&public=true" : poemForm.serialize();
    var req = $.ajax({
        url : poemForm.attr("action"),
        data: data ,
        type : 'POST'
    });


    req.done(function (data) {
        data = data.split("#");
        if (data[0] === "success"){
            message("Úspešne sme uložili báseň!", "success");
            if (data.length > 1){
                $("#poem_id").val(data[1]);
            }
        }
        else{
            message("Nepodarilo sa nám uložiť báseň");
        }

    })
}

var rhymeSubmitButton = $('#rhyme-submit-button');

rhymeSubmitButton.click(function (event) {
    event.preventDefault();
    var string = $('#rhyme-string');
    var number = $('#rhyme-number');

    if (string.val().trim() !== ""){
        rhymeApi(string,number);
    }
});

function rhymeApi(text,count) {
    var form = $("#rhyme-form");
    var req = $.ajax({
        url : form.attr("action"),
        data: form.serialize() ,
        type : 'GET'
    });

    console.log(form.serialize() );


    req.done(function (data) {
        data = data.split("#");
        document.getElementById("rhymes-result").innerHTML = "";

        for (let i = 0; i < data.length; i++) {
            if (i !== data.length -1) newRhymeResult(data[i]);
        }
    })
}

function newRhymeResult(text) {
    var el = document.createElement("p");
    el.classList.add("rhymes-result-container");
    el.classList.add("rhymes-animate")
    el.textContent = text;

    document.getElementById("rhymes-result").append(el);
}

