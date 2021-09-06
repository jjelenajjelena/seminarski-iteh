@extends('layouts.app')

@section('content')
    <input hidden id="chartData" value='<?php echo json_encode($prijave); ?>'>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div id="chart_div"></div>
    <script>
        const chartData = JSON.parse(document.getElementById("chartData").value);
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Godina, mesec', 'Broj prijava'],
                ...chartData.map(cd => {
                    return [`${cd.year}, ${cd.month}`, cd.data]
                })
            ]);


            var options = {
                title: 'Prijave za vakcinisanje',
                annotations: {
                    alwaysOutside: true,
                    textStyle: {
                        fontSize: 14,
                        color: '#000',
                        auraColor: 'none'
                    }
                },
                hAxis: {
                    title: 'Godina, mesec',
                    format: 'h:mm a',
                    viewWindow: {
                        min: [7, 30, 0],
                        max: [17, 30, 0]
                    }
                },
                vAxis: {
                    title: 'Broj prijavljenih'
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
@endsection
