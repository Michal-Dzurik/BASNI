var file = document.getElementById("file");
var fileText = file.nextElementSibling;
var button = $("#button");
var form = $("#form");
var description = "";


file.addEventListener('change', function() {
    if( !file.files.length == 0 ){
        fileText.textContent = "Fotka vložená";
        fileText.style.color = "#ffffff";
        file.parentElement.style.background = "#0f468394";

        var url = window.URL.createObjectURL(this.files[0]);
        file.parentElement.previousElementSibling.setAttribute("src", url)
    }
    else{
        fileText.textContent = "Vložte fotku";
        fileText.style.background = "#ffffff";
        fileText.style.color = "#000000";
    }
});

button.click(function (event) {
    event.preventDefault();

    if (confirm("Ste si si istý, že chcete odoslať formulár?")){
        update();
    }

});

function update(){
    var formData = new FormData();

    var fileData = document.getElementById("file").files[0];
    description = document.getElementById("description").value;
    var id = document.getElementById("id").value;

    formData.append("description", description);
    formData.append('file', fileData);
    formData.append('id', id);

    var req = $.ajax({
        url : form.attr('action'),
        type : 'POST',
        data : formData,
        cache: false,
        contentType: false,
        processData: false
    });

    req.done(function (data) {
        data = data.split("#");
        if (data[0] === "success"){
            if (data[1] === "all"){
                message("Úspešne sme vám zmenili popis, aj profilovú fotku", "success");
            }
            else{
                message("Úspešne sme vám zmenili popis", "success");
            }

        }
        else if (data[0] === "database"){
            message("Nepodarilo sa nám zmeniť popis");
        }
        else if (data[0] === "type"){
            message("Profilová fotka musí byť formátu jpg");
        }
        else if (data[0] === "storage"){
            message("Nepodarilo sa nám zmeniť profilovú fotku");
        }
        else if (data[0] === "size"){
            message("Môžete pridať len fotku, ktorá má menej ako 3MB");
        }
        else{
           message("Nastal problém so serverom, profím kontaktujte nás");
        }

    })

}


