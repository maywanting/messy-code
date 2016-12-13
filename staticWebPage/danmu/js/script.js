$(document).ready(function() {
    $("#send_sim").click(function() {
        var content = $("#content").val();
        move_dm(content);
    });

    $("#send_top").click(function() {
        var content = $("#content").val();
        top_dm(content);
    })

    var num = {
        sim : 0,
        top : 0
    };

    var move_dm = function(content) {
        num.sim++;
        $("<div class='dm-message'>" + content + "</div>")
            .css({
                "right" : "50px",
                "top" : get_top("sim") + "px"
            }).appendTo(".dm-body")
            .animate({"left" : "50px"}, 6000, function() {
                this.remove();
            });
    }

    var top_dm = function(content) {
        num.top++;
        var top = $("<div class='dm-message'></div>").css({
            "width": "100%",
            "top" : get_top("top") + "px",
            "text-align": "center"
        }).appendTo(".dm-body");
        $("<div>" + content + "</div>")
            .appendTo(top)
            .fadeOut(6000);
    }

    var get_top = function(type) {
        var origin = 20;
        var real_num = (num[type]-1) % 10;
        return origin + real_num * 30;
    }
});
