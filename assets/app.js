/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

// or you can include specific pieces
// require('bootstrap/js/dist/tooltip');
// require('bootstrap/js/dist/popover');

$(document).ready(() => {
    $('[data-toggle="popover"]').popover();
});

$(".navbar .nav-link").on("click", function(){
    $(".navbar").find(".active").removeClass("active");
    $(this).addClass("active");
});

$(window).scroll(function () {
    let $height = (typeof window.outerHeight != 'undefined') ?
        Math.max(window.outerHeight, $(window).height()) - 20 : $(window).height();
    $('nav').toggleClass('scrolled navbar-light', $(this).scrollTop() > $height - 10);
    $('.nav-item .btn').toggleClass('btn-top btn-scrolled', $(this).scrollTop() > $height - 10);
    $('footer').toggleClass('scrolled', $(this).scrollTop() > 1);
});

// Change width value on page load
$(document).ready(function(){
    responsive_resize();
});

// Change width value on user resize, after DOM
$(window).resize(function(){
    responsive_resize();
});

function responsive_resize(){
    if ($(window).width() < 768) {
        $('nav').addClass('navbar-dark');
        $(window).scroll(function () {
            let $height = $(window).height();
            if ($(this).scrollTop() > $height - 40) {
                $('nav').addClass('scrolled navbar-light').removeClass('navbar-dark');
            } else {
                $('nav').addClass('navbar-dark');
            }
        });
    }
}

$('.custom-file-input').on('change', (event) => {
    const inputFile = event.currentTarget;
    $(inputFile).parent()
        .find('.custom-file-label')
        .html(inputFile.files[0].name);
});