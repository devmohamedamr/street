/**
 * Created by MOHAMED on 13/04/2017.
 */
$(document).ready(function(){
    $.ajax({
        url: "http://localhost/streetu/admin/attendance_chart.php",
        method: "GET",
        success: function(data) {
            console.log(data);
            var month = [];
            var number = [];

            for(var i in data) {
                month.push("month " + data[i].month);
                number.push(data[i].number);
            }

            var chartdata = {
                labels: month,
                datasets : [
                    {
                        label: 'Player Score',
                        backgroundColor: 'rgba(200, 200, 200, 0.75)',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: score
                    }
                ]
            };

            var ctx = $("#mycanvas");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });
});