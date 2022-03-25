//variables
var email, password, focused,
    button = $("button"),
    input = $('input:not(:checkbox)'),
    nav = $(".right-navigation"),
    mobileNav = $(".mobile-navigation");


//events
$("body").keydown(function (event) {
    if (event.which === 13){
        event.preventDefault();
    }
})

// UX during registration
input.keyup(function (event) {
    focused = $(":focus");

    if (focused.attr("name") !== "password" && event.which === 13){
        focused.parent().first().next().children().focus();
    }
    else if (focused.attr("name") === "password" && event.which === 13){
        if (isFormValid()){
            if (confirm("Ste si si istý, že chcete odoslať formulár?")){
                logIn();
            }
        }
    }
});

// button submit
button.click(function (event) {
    event.preventDefault();

    if (isFormValid()){
       logIn();
    }

});

// automatic complete login and password from LS
if (localStorage.getItem("email") !== undefined || localStorage.getItem("email") !== ""){
    $('input[name="email"]').val(localStorage.getItem("email"));
    $('input[name="password"]').val(localStorage.getItem("password"));
}

function variablesRefresh() {
    email = $('input[name="email"]').val();
    password = $('input[name="password"]').val();
}

function isFormValid() {
    variablesRefresh();

    if (!notEmpty(email) && notEmpty(password)){
        message("Meno nie je vyplnené");
        return false;
    }
    if (notEmpty(email) && !notEmpty(password)){
        message("Heslo nie je vyplnené");
        return false;
    }
    if (!notEmpty(email) && !notEmpty(password)){
        message("Nič nie je vyplnené");
        return false;
    }
    else {
        return true;
    }

}

function saveLogin() {
    localStorage.setItem("email", email);
    localStorage.setItem("password", password);
}

var form = $("#form");

function logIn(){
    var req = $.ajax({
        url : form.attr('action'),
        type : 'POST',
        data : form.serialize()
    });

    req.done(function (data) {
        console.log(data);
        data = data.split("#");
        if (data[0] === "success"){
            message("Úspešne sme vás prihlásili!", "success");
            updateNav(data[1]);

            var checkbox = $("input[type='checkbox']");
            if (checkbox.prop('checked')){
                saveLogin();
            }
        }

        else if (data[0] === "password"){
            message("Heslo nie je správne");
        }
        else message("Nepodarilo sa nám Vás prihlásiť");
    })

}

function updateNav(id) {
    nav.children(".to-change").remove();
    nav.html("<li class=\"add-button\">\n" +
        "                <a href=\"../edit/\">+</a>\n" +
        "            </li>\n" +
        "            <li class=\"signed-in\">\n" +
        "                <a href=\"../sign-out/\">Odhlásiť sa</a>\n" +
        "            </li>\n" +
        "            <li class=\"signed-in\">\n" +
        "                <a href=\"../profile/index.php?id=" + id + " \">Profil</a>\n" +
        "            </li>");

    mobileNav.children(".to-change").remove();
    var prevElements = mobileNav.html();
    mobileNav.html(prevElements + "<li>\n" +
        "                <a href=\"../edit/\">Vytvoriť báseň</a>\n" +
        "            </li>\n" +
        "            <li class=\"signed-in\">\n" +
        "                <a href=\"../sign-out/\">Odhlásiť sa</a>\n" +
        "            </li>\n" +
        "            <li class=\"signed-in\">\n" +
        "                <a href=\"../profile/index.php?id=" + id + " \">Profil</a>\n" +
        "            </li>")
}
