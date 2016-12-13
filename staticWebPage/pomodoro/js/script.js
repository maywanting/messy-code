$(document).ready(function() {
    var type = 1; //1--work, 0--break;
    var workTime = 25;
    var breakTime = 5;
    var min = 25;
    var sec = 0;
    var sta = 0;
    var t;
    $("#screen").click(function() {
        console.log(type);
        if (sta == 1) {
            sta = 0;
            timeStop();
        } else {
            sta = 1;
            timeRun();
        }
    });

    $(".button").click(function() {
        var value = $(this).attr("value");
        var addOrMin = value[value.length-1];
        if (value.slice(0, -1) == "work") {
            if (addOrMin == "-") {
                workTime--;
                if (workTime < 0) {
                    workTime = 0;
                }
            } else {
                workTime++;
            }
            $("#work-time").text(workTime);
            if (type == 1) {
                timeStop();
                min = workTime;
                sec = 0;
                setScreen();
            }
        } else {
            if (addOrMin == "-") {
                breakTime--;
                if (breakTime < 0) {
                    breakTime = 0;
                }
            } else {
                breakTime++;
            }
            $("#break-time").text(breakTime);
            if (type == 0) {
                timeStop();
                min = breakTime;
                sec = 0;
                setScreen();
            }
        }

        console.log(type);
        console.log(addOrMin);
    })

    var timeRun = function() {
        sec--;
        if (sec < 0) {
            sec = 59;
            min--;
            if (min < 0) {
                if (type == 1) {
                    type = 0;
                    min = breakTime;
                    sec = 0;
                } else {
                    type = 1;
                    min = workTime;
                    sec = 0;
                }
            }
        }
        setScreen();
        t = setTimeout(timeRun,1000);
    }

    var timeStop = function() {
        clearTimeout(t);
    }

    var setScreen = function() {
        var time = "";
        if (min > 9) {
            time += min;
        } else {
            time += "0" + min;
        }
        time += ":";
        if (sec > 9) {
            time += sec;
        } else {
            time += "0" + sec;
        }
        console.log(time);
        console.log(type);
        $(".time").text(time);
        if (type == 1) {
            $(".type").text("工作");
        } else {
            $(".type").text("休息");
        }
    }
});
