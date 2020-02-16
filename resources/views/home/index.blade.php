@extends('layouts.app')

@section('content')
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">@lang('layouts.sidebar.dashboard')</h3>
        </div>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body"> 
                        <h4 class="card-title">Number members of clubs<h4>
                        <div class="panel-body">
                            <canvas id="barChart" height="280" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body"> 
                        <h4 class="card-title">Members<h4>
                        <div class="panel-body">
                            <canvas id="donutChart" height="280" width="600"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('extra_scripts')

<script>
 $(document).ready(function(){
  
    var clubs = new Array("Club 1", "Club 2", "Club 3", "Club 4","Club 5", "Club 6");
    var numberMembers = new Array(500, 280, 560, 1000, 700, 410);
    var barChartCanvas = $('#barChart').get(0).getContext('2d');
    var myChart = new Chart(barChartCanvas, {
                  type: 'bar',
                  data: {
                      labels:clubs,
                      datasets: [{
                        label: 'Number members of club',
                        data: numberMembers,
                        borderWidth: 1,
                        backgroundColor : '#00c0ef',
                        //borderColor: 'rgba(60,141,188,0.8)',                     
                      }]
                  },
                  options: {
                      scales: {
                          yAxes: [{
                              ticks: {
                                  beginAtZero:true
                              }
                          }]
                      }
                  }
              });
 
    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')  
    var donutChart = new Chart(donutChartCanvas, {
                    type: 'doughnut',
                    data: {
                            labels: [
                                'Active members', 
                                'InActive members'
                            ],
                            datasets: [
                                {
                                data: [1000,100],
                                backgroundColor : [ '#00c0ef', '#f56954'],
                                }
                            ]
                        },
                    options: {
                            maintainAspectRatio : false,
                            responsive : true,
                        }      
                });


 });
</script>

@endsection
