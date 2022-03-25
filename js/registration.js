//variables
var name, lastName, login, age, email, password, password_r,focused;
var button = $("button");
var input = $('input:not(:checkbox)');

//events
$("body").keydown(function (event) {
    if (event.which === 13){
        event.preventDefault();
    }
})

// UX during registration
input.keydown(function (event) {

    focused = $(":focus");
    if (focused.attr("name") !== "password_repeat" && event.which === 13){
        focused.parent().next().children().focus();
    }
    else if (focused.attr("name") === "password_repeat" && event.which === 13){
        if (isFormValid()){
            if (confirm("Ste si si istý, že chcete odoslať formulár?")){
                logIn();
            }
        }
    }
})

// Button submit
button.click(function (event) {
    event.preventDefault();

    if (isFormValid()){
        if (confirm("Ste si si istý, že chcete odoslať formulár?")){
            register();
        }
    }

});

// functions

function variablesRefresh() {
    name = $('input[name="name"]').val();
    lastName = $('input[name="last_name"]').val();
    login = $('input[name="login"]').val();
    age = $('input[name="age"]').val();
    email = $('input[name="email"]').val();
    password = $('input[name="password"]').val();
    password_r = $('input[name="password_repeat"]').val();
}

function isFormValid() {
    variablesRefresh();

    if (!notEmpty(name) || !notEmpty(lastName) || !notEmpty(age) || !notEmpty(email) || !notEmpty(password ) || !notEmpty(password_r)) {
        message("Niečo nie je vyplnené");
        return false;
    }
    if (!emailValid(email)){
        message("Email nie je validny");
        return false;
    }
    if (password_r !== password && notEmpty(password)){
        message("Heslá sa nezhodujú");
        return false;
    }
    if ( notEmpty(name) && notEmpty(lastName) && notEmpty(login) && notEmpty(age) && notEmpty(email) && notEmpty(password)){
        return true;
    }

}

var form = $("#form");

// Registration function
function register(){
    var req = $.ajax({
        url : form.attr('action'),
        type : 'POST',
        data : form.serialize()
    });

    req.done(function (data) {
        console.log(data);
        if (data === "success"){
            message("Úspešne sme vás zaregistrovali!", "success");
        }
        else if (data === "database"){
            message("Nepodarilo sa nám uložiť Vás do databázy");
        }
        else if (data === "login"){
            message("Tento login , je už použitý");
        }
        else if (data === "email"){
            message("Tento email , je už použitý");
        }
        else if (data === "login & email"){
            message("Aj email aj login je už použitý");
        }
        else message("Nepodarilo sa nám Vás zaregistrovať");
    })

}
