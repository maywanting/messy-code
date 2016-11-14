$(document).ready(function(){
    var timely = {
        "time" : 3,
        "nowFlag" : 0,
        "content" : ['first', 'second', 'third', 'fourth'],
    }

    var changeContent = function () {
        var flag = timely.nowFlag % timely.content.length;
        $('.content').text(timely.content[flag]);
        timely.nowFlag++;
    }

    window.setInterval(changeContent, 1000);
})
