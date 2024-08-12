<div>
    <x-slot name="title">
       Admin Dashboard
    </x-slot>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 m-0 font-weight-bold text-primary">Dashboard</h1>
        </div>
        <!-- Content Row --> 
        <div class="row justify-content-center">
            <!-- Total Documents Card -->
            <div class="col-xl-3 col-md-6 mb-4" style="height: 100px;">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center"> <!-- Added text-center class -->
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Documents</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><span>{{ $totalDocument }}</span></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Serve clients Card -->
            <div class="col-xl-3 col-md-6 mb-4" style="height: 100px;">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center"> <!-- Added text-center class -->
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Serve Clients</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><span>{{ $totalDocument }}</span></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Assistance Card -->
            <div class="col-xl-3 col-md-6 mb-4" style="height: 100px;">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center"> <!-- Added text-center class -->
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Assistance</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><span>{{ $totalDocument }}</span></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-file fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>


            <!-- Clients Assistance Release Card -->
            <div class="col-xl-3 col-md-6 mb-4" style="height: 100px;">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center"> <!-- Added text-center class -->
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Clients Assistance Release</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><span>{{ $totalDocument }}</span></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            </div>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
                <style>
                    .text-custom-blue { color: #1a4b99; }
                    .text-custom-orange { color: #cc8400; }
                    .text-custom-yellow { color: #c9a000; }
                    .text-custom-green { color: #388e3c; }
                </style>
                <title>Document</title>
            </head>
            <body>
              @php 
              $totalAge = "";
       
          @endphp  

                <div class="row">
                    <div class="col-xl-4 col-lg-5 mb-4" style="margin-left: 100px; margin-right: 100px;">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">Assistance by Age Group</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-pie pt-4 pb-2">
                                    <canvas id="userPieChart"></canvas>
                                </div>
                                <div class="mt-4 text-center small">
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-custom-blue"></i> 18-29 {{ $totalAge }}
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-custom-orange"></i> 30-44 {{ $totalAge }}
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-custom-yellow"></i> 45-59 {{ $totalAge }}
                                    </span>
                                    <span class="mr-2">
                                        <i class="fas fa-circle text-custom-green"></i> 60-70 {{ $totalAge }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
            </html>
            
        <div class="col-xl-6 col-lg-7 mb-4"> <!-- Adjusted width classes -->
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">File Types</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-bar pt-4 pb-2">
                        <canvas id="recordBarChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-square text-primary"></i> Administrative: {{ $totalAdministrative }}
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-square text-success"></i> Financial: {{ $totalFinancial }}
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-square text-info"></i> Legal: {{ $totalLegalRecords }}
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-square text-warning"></i> Personnel: {{ $totalPersonnelRecords }}
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-square text-danger"></i> Social Services: {{ $totalSocialServices }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="{{asset('admin_assets/js/chart.js')}}"></script>
        <script>
          document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('userPieChart').getContext('2d');
            var myPieChart = new Chart(ctx, {
              type: 'pie',
              data: {
                labels: ['Permanent', 'Temporary'],
                datasets: [{
                  data: [{{ $totalDoctype }}, {{ $totalDoctype1 }}],
                  backgroundColor: ['#4e73df', '#1cc88a'],
                  hoverBackgroundColor: ['#2e59d9', '#17a673'],
                  hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
              },
              options: {
                maintainAspectRatio: true,
                tooltips: {
                  backgroundColor: "rgb(255,255,255)",
                  bodyFontColor: "#858796",
                  borderColor: '#dddfeb',
                  borderWidth: 1,
                  xPadding: 15,
                  yPadding: 15,
                  displayColors: false,
                  caretPadding: 10,
                },
                legend: {
                  display: false,
                },
                cutoutPercentage: 80,
              },
            });
            var ctxBar = document.getElementById('recordBarChart').getContext('2d');
            var myBarChart = new Chart(ctxBar, {
              type: 'bar',
              data: {
                labels: ['Administrative', 'Financial', 'Legal', 'Personnel', 'Social Services'],
                datasets: [{
                  label: 'Number of Records',
                  data: [
                    {{ $totalAdministrative }},
                    {{ $totalFinancial }},
                    {{ $totalLegalRecords }},
                    {{ $totalPersonnelRecords }},
                    {{ $totalSocialServices }}
                  ],
                  backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                  hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#d63031'],
                  borderColor: "rgba(234, 236, 244, 1)",
                }],
              },
              options: {
                maintainAspectRatio: false,
                scales: {
                  x: {
                    grid: {
                      display: false
                    },
                    ticks: {
                      display: false // Hide the side numbers (ticks)
                    }
                  },
                  y: {
                    grid: {
                      drawBorder: false,
                      color: function (context) {
                        if (context.tick.value < 0) {
                          return '#f00';
                        }
                        return '#ddd';
                      }
                    },
                    ticks: {
                      display: false, // Hide the y-axis numbers (ticks)
                    }
                  }
                },
                tooltips: {
                  backgroundColor: "rgb(255,255,255)",
                  bodyFontColor: "#858796",
                  borderColor: '#dddfeb',
                  borderWidth: 1,
                  xPadding: 15,
                  yPadding: 15,
                  displayColors: false,
                  caretPadding: 10,
                },
                legend: {
                  display: false,
                },
              },
            });

             var ctxBar = document.getElementById('recordBarChart').getContext('2d');
            var myBarChart = new Chart(ctxBar, {
              type: 'bar',
              data: {
                labels: ['Administrative', 'Financial', 'Legal', 'Personnel', 'Social Services'],
                datasets: [{
                  label: 'Number of Records',
                  data: [
                    {{ $totalAdministrative }},
                    {{ $totalFinancial }},
                    {{ $totalLegalRecords }},
                    {{ $totalPersonnelRecords }},
                    {{ $totalSocialServices }}
                  ],
                  backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b'],
                  hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#d63031'],
                  borderColor: "rgba(234, 236, 244, 1)",
                }],
              },
              options: {
                maintainAspectRatio: false,
                scales: {
                  x: {
                    grid: {
                      display: false
                    },
                    ticks: {
                      display: false // Hide the side numbers (ticks)
                    }
                  },
                  y: {
                    grid: {
                      drawBorder: false,
                      color: function (context) {
                        if (context.tick.value < 0) {
                          return '#f00';
                        }
                        return '#ddd';
                      }
                    },
                    ticks: {
                      display: false, // Hide the y-axis numbers (ticks)
                    }
                  }
                },
                tooltips: {
                  backgroundColor: "rgb(255,255,255)",
                  bodyFontColor: "#858796",
                  borderColor: '#dddfeb',
                  borderWidth: 1,
                  xPadding: 15,
                  yPadding: 15,
                  displayColors: false,
                  caretPadding: 10,
                },
                legend: {
                  display: false,
                },
              },
            });
          });
        </script>


 <!-- Bar CHART (Assistance Budget by Type and Gender)-->
<div class="col-xl-6 col-lg-7 mb-4"> <!-- Adjusted width classes -->
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Assistance Budget by Type and Gender</h6>
    </div>
    <!-- Card Body -->
    <!-- Nigga data-->
    @php 
        $totalMedical = 10000;
     $totalFuneral=50000; 
     $totalFoodAssistance=80000;
    @endphp    
    
    <div class="card-body">
      <div class="chart-bar pt-4 pb-2">
        <canvas id="BarChart"></canvas>
      </div>
      <div class="mt-4 text-center small">
        <span class="mr-2">
          <i class="fas fa-square text-primary"></i> Medical: {{ $totalMedical }}
        </span>
        <span class="mr-2">
          <i class="fas fa-square text-success"></i> Funeral: {{ $totalFuneral }}
        </span>
        <span class="mr-2">
          <i class="fas fa-square text-info"></i> Food Assistance: {{ $totalFoodAssistance }}
        </span>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('admin_assets/js/chart.js') }}"></script>

<script>
  var Bar = document.getElementById('BarChart').getContext('2d'); 
  var BarChart = new Chart(Bar, {

    type: 'bar',
    data: {
      labels: ['Medical', 'Funeral', 'Food Assistance'],
      datasets: [{
        label: 'Number of Records',
        data: [
          {{ $totalMedical }},
          {{ $totalFuneral }},
          {{ $totalFoodAssistance }},
        ],
        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
        borderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      scales: {
        x: {
          grid: {
            display: false
          },
          ticks: {
            display: false // Hide the side numbers (ticks)
          }
        },
        y: {
          grid: {
            drawBorder: false,
            color: function (context) {
              if (context.tick.value < 0) {
                return '#f00';
              }
              return '#ddd';
            }
          },
          ticks: {
            display: false, // Hide the y-axis numbers (ticks)
          }
        }
      },
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false,
      },
    },
  });
</script>


 <!-- ----------------Line Chart------------------------------>

 <div class="col-xl-6 col-lg-7 mb-4">
  <div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      <h6 class="m-0 font-weight-bold text-primary">Assistance Release by DOB</h6>
    </div>

   
    <div class="card-body">
      <div class="linechart pt-4 pb-2">
        <canvas id="LineChart"></canvas>
      </div>
    
        </span>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('admin_assets/js/chart.js') }}"></script>

<script>
  var ctx = document.getElementById('LineChart').getContext('2d');
  var LineChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', '2020', '2021', '2022', '2023', '2024'],
      datasets: [{
        label: 'Assistance Release',
        data: [31000, 40000, 28000, 51000, 42000, 109000, 100000, 120000, 150000, 170000, 190000, 210000, 230000, 250000, 270000, 290000, 300000, 310000, 320000, 330000, 340000, 350000, 360000, 370000, 380000],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: '#4f35a1',
        borderWidth: 2,
        fill: false,
      }],
    },
    options: {
      maintainAspectRatio: false,
      scales: {
        x: {
          grid: {
            display: false
          },
          ticks: {
            display: true // Show the x-axis numbers (ticks)
          }
        },
        y: {
          grid: {
            drawBorder: false,
            color: function (context) {
              if (context.tick.value < 0) {
                return '#f00';
              }
              return '#ddd';
            }
          },
          ticks: {
            display: true, // Show the y-axis numbers (ticks)
            callback: function(value, index, values) {
              return value / 1000 + 'k'; // Display Y-axis values in thousands (e.g., 1000 => 1k)
            }
          },
          min: 0,
          max: 400000,
        }
      },
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false,
      },
      elements: {
        point: {
          radius: 0
        }
      }
    },
  });
</script>

</script>
    </div>
</div>

