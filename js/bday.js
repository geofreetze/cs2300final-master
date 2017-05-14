$(document).ready(function(){

    // http://stackoverflow.com/questions/23671407/restrict-future-dates-in-html-5-data-input
    var now = new Date();
    var maxDate = now.toISOString().substring(0,10);
    $('#bday').prop('max', maxDate);
});