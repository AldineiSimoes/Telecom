<!-- <link rel='stylesheet' href='<?php echo BASE_URL; ?>/assets/css/c3.css'> -->
<div class="container">
    <br/>


    <div class="text-left row" >
        <div class="col-lg-12 text-muted" style="font-size: 20px;">
            <img src="<?php echo BASE_URL; ?>/assets/images/success.png" style="width: 20px;height: 20px;margin-left: 40px;"> RESUMO OPERADORES / OPERADORAS
            <hr />                
        </div>
    </div>

    <div class="row">

        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center w-100">STATUS OPERADORES</div>
                <div class="PeriodoSel " id="grafico">

                    <canvas id="myChart" width="150px" height="150px"></canvas>
                </div>
            </div>
        </div>

<!--        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center w-100">USO DAS OPERADORAS</div>
                <div class="PeriodoSel">

                    <div id="volumeOperadoras">
                        <canvas id="myChart2" width="400" height="400"></canvas>
                    </div>

                </div>
            </div>
        </div>-->
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center w-100">CANAIS OPERADORAS</div>
                <div class="PeriodoSel ">
                    <div  id="myChart3" style='width: 100%;height: 260px;'></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading text-center w-100">STAUS DE DISCAGEM</div>
                <div class="PeriodoSel">
                    <div  id="myChart4" style='width: 100%;height: 260px;'></div>
                </div>
            </div>
        </div>


    </div>
<!--    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading text-center w-100">LIGAÇÕES ON-LINE</div>
                <div class="PeriodoSel" style='width: 100%;height: 260px;'>
                    <canvas id="myChart6" width="400" height="150"></canvas>
                </div>
            </div>
        </div>
    </div>-->
    <!-- <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/Chart.min.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/c3.js"></script>
    <script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/d3.min.js"></script> -->

    <script>
        var ctx = document.getElementById("myChart2");
        var myChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
            },
            options: {
                title: {
                    display: true,
                    text: 'USO DAS OPERADORAS'
                },
                scales: {
                    yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                }
            }
        });
    </script>

<!-- <script>
new Chart(document.getElementById("myChart3"), {
    type: 'bar',
    data: {
      labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
      datasets: [
        {
          label: "Population (millions)",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [2478,5267,734,784,433]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Predicted world population (millions) in 2050'
      }
    }
});
</script> -->

    <script>
        new Chart(document.getElementById("myChart6"), {
            type: 'line',
            data: {
                labels: [1500, 1600, 1700, 1750, 1800, 1850, 1900, 1950, 1999, 2050],
                datasets: [{
                        data: [86, 114, 106, 300, 200, 400, 500, 600, 200, 150],
                        label: "Total On-Line",
                        borderColor: "#3e95cd",
                        fill: true
                    },
                ]
            },
            
            options: {
                title: {
                    display: true,
                    text: 'Chamadas On-line'
                }
            }
        });
    </script>

    <script>
        $(document).ready(function () {
            c3.generate({
                bindto: '#myChart3',

                data: {
                    x: 'x',
                    type: 'bar',
                    labels: true,
                    columns: [
                        ['x', 'VIVO', 'VONEX', 'LEMAR', 'EMBRATEL'],
                        ['CANAIS', 300, 400, 600, 300],
                        ['EM USO', 150, 250, 200, 100],
                        ['LIVRES', 230, 250, 150, 200],
                    ],
                    colors: {
                        'CANAIS': '#4682B4',
                        'EM USO': '#CD5C5C',
                        'LIVRES': '#9ACD32',

                    },
                    groups: [
                        ['CANAIS', 'EM USO', 'LIVRES']
                    ]
                },
                axis: {
                    y: {
                        show: false
                    },
                    x: {
                        type: 'category',

                    }
                }

            });

        });
    </script>
    <script>
        $(document).ready(function () {
            c3.generate({
                bindto: '#myChart4',

                data: {
                    x: 'x',
                    type: 'bar',
                    labels: true,
                    columns: [
                        ['x', 'VIVO', 'VONEX', 'LEMAR', 'EMBRATEL'],
                        ['CANAIS', 300, 400, 600, 300],
                        ['EM USO', 150, 250, 200, 100],
                        ['LIVRES', 230, 250, 150, 200],
                    ],
                    colors: {
                        'CANAIS': '#4682B4',
                        'EM USO': '#CD5C5C',
                        'LIVRES': '#9ACD32',

                    },
                    groups: [
                        ['CANAIS', 'EM USO', 'LIVRES']
                    ]
                },
                axis: {
                    y: {
                        show: false
                    },
                    x: {
                        type: 'category',

                    }
                }

            });

        });
    </script>