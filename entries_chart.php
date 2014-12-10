<div class="bs-examples" style="border:1px solid black; width:500px;">
    <div id="recordChart" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h1 class="modal-title text-primary fa fa-user "><?php echo " Entry"; ?> Chart</h1>
                </div>
                <div class="modal-body">
                    <div id="canvas-holder">
            <canvas id="chart-area" width="300" height="300"/>
        </div>


    <script>

        var myDoughnutChart = [
                {
                    value: 500,
                    color:"#F7464A",
                    highlight: "#FF5A5E",
                    label: "Sequence Lenght"
                }

            ];

            window.onload = function(){
                var ctx = document.getElementById("chart-area").getContext("2d");
                window.myDoughnutChart = new Chart(ctx).Doughnut(myDoughnutChart, {responsive : false});
            };



    </script>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>