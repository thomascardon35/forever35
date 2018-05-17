"use strict";


var newsEvents = [
    { event: "Brocante du Theil le dimanche 22 avril 2018" } ,
    { event: "Fete de la roche aux fées le samedi 18 juin 2018"},
    { event: "Fete de Retiers le dimanche 24 juin 2018"},
    { event: "Braderie de Rennes le 25 septembre 2018"}
];

var state;

function slider(){
    var sliderNewsEvents;
    sliderNewsEvents = $('.slider-events .bg-slider p');
    sliderNewsEvents.text(newsEvents[state.index].event);

};

function sliderNext(){
    state.index++;
    if(state.index == newsEvents.length){
        state.index = 0;
    };
    slider();
};

function sliderTimer(){
    if(state.timer == null){

        state.timer = window.setInterval(sliderNext, 3000);
    };
};

$(function(){

    state       = {};
    state.index = 0;
    state.timer = null;

    sliderTimer();
});