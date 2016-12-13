$(document).ready(function() {

    var gameType = {
        computer : "circle",
        user: "circle"
    };

    var role = {
        circle : "O",
        cross : "×"
    };

    //弹出框处理对象
	var fx = {
		"initModal" : function() {
			if ( $(".model-windows").length == 0 ) {
				return $("<div>").hide().addClass("modal-window").appendTo("body");
			} else {
				return $(".model-windows");
			}
		},

		"boxin" : function(data, modal) {
			$("<div>")
				.hide()
				.addClass("modal-overlay")
				.click(function(event) {
					fx.boxout(event);
				})
				.appendTo("body");

			modal
				.hide()
				.append(data)
				.appendTo("body");

			$(".modal-window, .modal-overlay").fadeIn("slow");
		},

		"boxout" : function(event) {
			if (event != undefined) {
				event.preventDefault();
			}

			$("a").removeClass("active");

			$(".modal-window, .modal-overlay").fadeOut("slow", function() {
				$(this).remove();
			});
		}
	};

    var gameData = {
        user : [[0, 0, 3], [0, 3, 0], [0, 0, 0]],
        computer: [[0, 0, 0], [0, 0, 0], [0, 0, 0]],
        remain: [[1, 1, 1], [1, 1, 1], [1, 1, 1]]
    };

    var game = {

        "init" : function() {
            if (gameType.user === gameType.computer) {
                console.log("noRole");
                return selectRole();
            }
            $(".box").empty();
            gameData.user = [[0, 0, 0], [0, 0, 0], [0, 0, 0]];
            gameData.computer = [[0, 0, 0], [0, 0, 0], [0, 0, 0]];
            gameData.remain = [[1, 1, 1], [1, 1, 1], [1, 1, 1]];
        },

        "computer" : function() {
            var num = 0;
            do {
                num = Math.floor(Math.random() * 9);
            } while (game.checkRemain(num) === false);

            game.setChess(num, "computer");

            if (game.checkWin("computer")) {
                alert("game over, Computer Win!!!");
                location.reload();
            }

            if (game.checkFair()) {
                alert("game over, and no one win");
                location.reload();
            }
        },

        "user" : function(num) {
            if(game.checkRemain(num) === true) {
                game.setChess(num, "user");

                if (game.checkWin("user")) {
                    alert("game over, User Win!!!");
                    location.reload();
                }

                if (game.checkFair()) {
                    alert("game over and no one win");
                    location.reload();
                }
                game.computer();
            }
        },

        "checkRemain" : function(num) {
            var x = Math.floor(num / 3);
            var y = num % 3;
            var tempRemain = gameData.remain;
            if (tempRemain[x][y] == 1) {
                return true;
            } else {
                return false;
            }
        },

        "checkFair" : function() {
            for (var i = 0; i < 3; i++) {
                for (var j = 0; j < 3; j++) {
                    if (gameData.remain[i][j]) {
                        return false;
                    }
                }
            }

            return true;
        },

        "checkWin" : function(type) {
            var originData = gameData[type];

            //same column win
            for (var i = 0; i < 3; i++) {
                if (originData[0][i] == 1 && originData[1][i] == 1 && originData[2][i] == 1) {
                    return true;
                }
            }

            //same row win
            for (var i = 0; i < 3; i++) {
                if (originData[i][0] == 1 && originData[i][1] == 1 && originData[i][2] == 1) {
                    return true;
                }
            }

            //inclined
            //1: up-left to down-right
            if (originData[0][0] == 1 && originData[1][1] == 1 && originData[2][2] == 1) {
                return true;
            }
            //2: up-right to down-left
            if (originData[0][2] == 1 && originData[1][1] == 1 && originData[2][0] == 1) {
                return true;
            }
            return false;
        },

        "setChess" : function(num, type) {
            x = Math.floor(num / 3);
            y = num % 3;

            gameData[type][x][y] = 1;
            gameData.remain[x][y] = 0;

            $("#"+num).text(role[gameType[type]]);
        }
    };

    var selectRole = function() {
        var modal = fx.initModal();
        var modalBody = "select a role<hr/><div class='buttons'><div class='button' id='circle'>O</div><div class='button' id='cross'>×</div></div>";
        fx.boxin(modalBody, modal);
    }

    selectRole();

    $(".button").click(function() {
        if (gameType.user == $(this).attr('id')) {
            gameType.computer = "cross";
        } else {
            gameType.user = "cross";
        }
        fx.boxout();
        game.init();
        game.computer();
    });

    $(".box").click(function() {
        var num = $(this).attr('value');
        if (gameType.user === gameType.computer) {
            selectRole();
        } else {
            game.user(num);
        }
    });
});
