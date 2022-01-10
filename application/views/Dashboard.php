<?php
defined('BASEPATH') or exit('No direct script access allowed');
include('Head.php');
include('Menu.php');
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<div class="content-wrapper">
  <section class="content-header">
    <h1>Dashboard</h1>
  </section>
  <section class="content">

  <p>
    <div class="row">
    <div class="col-md-6">
    <canvas id="myChart"></canvas></div>
    <div class="col-md-6">
    <canvas id="donutChart"></canvas></div>
    </div>
    
    
  </section>
  
</div>
<?php include('Foot.php'); ?>
<script>
//chartdemo();
function chartdemo()
{
  var data =  {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(254, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    }
    var options = {}
  var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data:data,

    // Configuration options go here
    options: {}
});

var ctx = document.getElementById('donutChart').getContext('2d');
var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: options
});
}
</script>
