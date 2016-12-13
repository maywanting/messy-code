$(document).ready(function() {
    var ans = "";
    var equation = "";
    $(".button").click(function() {
        var value = $(this).attr("value");
        switch (value) {
            case "DEL": {
                equation = equation.slice(0, -1);
                break;
            }
            case "AC": {
                equation = "";
                break;
            }
            case "Ans": {
                equation += ans;
                break;
            }
            case "=": {
                equation = eval(equation);
                ans = equation;
                break;
            }
            default :{
                equation += value;
            }
        }
        $("#screen").val(equation);
    });
});
