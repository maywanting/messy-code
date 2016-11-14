$(document).ready(function(){
    var timely = {
        "time" : 1000, //相隔的时间
        "nowFlag" : 0, //现在的标记
        "content" : ['first', 'second', 'third', 'fourth'], //循环内容
    }

    var changeContent = function () {
        var flag = timely.nowFlag % timely.content.length;
        $('.content').text(timely.content[flag]);
        timely.nowFlag++;
    }

    window.setInterval(changeContent, timely.time);
})
