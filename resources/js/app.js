require('./bootstrap');

import $ from 'jquery';
window.$ = window.jQuery = $;

import 'jquery-ui/ui/widgets/datepicker.js';

$('.datepicker').datepicker();

function showUsersTable() {
    var tabla = document.getElementById("tabla_usuarios");
    tabla.classList.remove("invisible");
}

import Chart from 'chart.js';

$( document ).ready(function() {
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['OHL', 'VIA PASS', 'IMDM', 'CPFI', 'TELEVIA'],
            datasets: [{
                label: '# Reporte Aforo 2021-04-20',
                data: [84378, 104370, 89670, 98378, 88935, 101430],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });

    $('.custom-file-input').on('change',function(){
        var fileName = document.getElementById("csv_url").files[0].name;
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

});
