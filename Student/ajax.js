$(document).ready(function() {
    $.getJSON("https://www.udacity.com/public-api/v0/courses", function(data) {
    $.each(data.courses, function(count) {
        console.log(data.courses[count].title);
        console.log(data.courses[count].homepage);
    });
});
});