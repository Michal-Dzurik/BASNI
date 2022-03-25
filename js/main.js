$(function() {
    var hamburger = $('.hamburger');
    var mobileNav = $('.mobile-navigation');

    hamburger.click(function () {
        $(this).toggleClass("hamburger-active");
        mobileNav.toggleClass("navigation-rolled");
    })
})