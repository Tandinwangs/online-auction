@include('admin.partials.navbar')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">
                <div class="card-body">
                  <h5 class="card-title">Items <span>| This Year</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalItemThisYear }}</h6>
                      <span class="text-success small pt-1 fw-bold">{{ $percentageIncrease }}%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->


            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card">

              <div class="filter">
                <form id="filterForm" method="GET" action="{{ route('dashboard') }}">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>
                        <li><a class="dropdown-item" href="#" onclick="applyFilter('today')">Today</a></li>
                        <li><a class="dropdown-item" href="#" onclick="applyFilter('month')">This Month</a></li>
                        <li><a class="dropdown-item" href="#" onclick="applyFilter('year')">This Year</a></li>
                    </ul>
                    <input type="hidden" name="filter" id="filterInput">
                </form>
              </div>

                <div class="card-body">
                <h5 class="card-title">Total Users <span>| {{ ucfirst($filter) }}</span></h5>


                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalUser }}</h6>
                      <span class="text-danger small pt-1 fw-bold">{{$percentageIncreaseUsers}}%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

            <!-- Reports -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul> -->
                </div>

                <div class="card-body">
                  <h5 class="card-title">Reports <span>/Today</span></h5>

                  <!-- Line Chart -->
                  <div id="reportsChart"></div>

                  <script>
                     document.addEventListener("DOMContentLoaded", () => {
                              new ApexCharts(document.querySelector("#reportsChart"), {
                                  series: [
                                      {
                                          name: 'Bids',
                                          data: [{{ $bidsToday }}, {{ $bidsThisMonth }}, {{ $bidsThisYear }}], // Ensure these values are correctly formatted
                                      },
                                      {
                                          name: 'Revenue',
                                          data: [{{ $revenueToday }}, {{ $revenueThisMonth }}, {{ $revenueThisYear }}],
                                      }
                                  ],
                                  chart: {
                                      height: 350,
                                      type: 'area',
                                      toolbar: {
                                          show: false
                                      }
                                  },
                                  markers: {
                                      size: 4
                                  },
                                  colors: ['#4154f1', '#2eca6a'],
                                  fill: {
                                      type: "gradient",
                                      gradient: {
                                          shadeIntensity: 1,
                                          opacityFrom: 0.3,
                                          opacityTo: 0.4,
                                          stops: [0, 90, 100]
                                      }
                                  },
                                  dataLabels: {
                                      enabled: false
                                  },
                                  stroke: {
                                      curve: 'smooth',
                                      width: 2
                                  },
                                  xaxis: {
                                      categories: ["Today", "This Month", "This Year"] // Correctly formatted array
                                  },
                                  tooltip: {
                                      x: {
                                          format: 'dd/MM/yy HH:mm'
                                      }
                                  }
                              }).render();
                          });

                  </script>

                  <!-- End Line Chart -->

                </div>

              </div>
            </div><!-- End Reports -->

            <!-- Recent Sales -->
            <div class="col-12">
              <div class="card recent-sales overflow-auto">

                <!-- <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div> -->

                <div class="card-body">
                  <h5 class="card-title">Latest Auction Lists <span></span></h5>

                  <table class="table table-borderless datatable">
                    <thead>
                      <tr>
                        <!-- <th scope="col">#</th> -->
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Starting Price</th>
                        <th scope="col">Auction Start</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($recentItems as $recentItem)
                      <tr>
                        <!-- <th scope="row"><a href="#">#2457</a></th> -->
                        <td>{{ $recentItem->name }}</td>
                        <td><a href="#" class="text-primary">{{ $recentItem->category->name }}</a></td>
                        <td>{{ $recentItem->starting_bid }}</td>
                        <td><span class="badge bg-success">{{ $recentItem->auction_start }}</span></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>

                </div>

              </div>
            </div><!-- End Recent Sales -->

          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Recent Activity <span>| Today</span></h5>

              <div class="activity">

              @php
              // Define an array of badge classes
              $badgeClasses = [
                'text-success',
                'text-danger',
                'text-primary',
                'text-info',
                'text-warning',
                'text-muted'
              ];
            @endphp

              @foreach ($recentActivities as $activity)
                  @php
                    // Randomly pick a badge class
                    $badgeClass = $badgeClasses[array_rand($badgeClasses)];
                  @endphp

                  <div class="activity-item d-flex">
                    <div class="activite-label">{{ $activity['time'] }}</div>
                    <i class='bi bi-circle-fill activity-badge {{ $badgeClass }} align-self-start'></i>
                    <div class="activity-content">
                      {{ $activity['message'] }}
                    </div>
                  </div>
                @endforeach

              </div>

            </div>
          </div>


          <div class="card">
          <div class="card-body pb-0">
              <h5 class="card-title">Payment Status Breakdown <span>| Current Year</span></h5>

              <div id="paymentChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  echarts.init(document.querySelector("#paymentChart")).setOption({
                    tooltip: {
                      trigger: 'item'
                    },
                    legend: {
                      top: '5%',
                      left: 'center'
                    },
                    color: ['#FFC300', '#F40000', '#252D60'],
                    series: [{
                      name: 'Payments',
                      type: 'pie',
                      radius: ['40%', '70%'],
                      avoidLabelOverlap: false,
                      label: {
                        show: false,
                        position: 'center'
                      },
                      emphasis: {
                        label: {
                          show: true,
                          fontSize: '18',
                          fontWeight: 'bold'
                        }
                      },
                      labelLine: {
                        show: false
                      },
                      data: [
                        { value: {{ $pendingCount }}, name: 'Pending' },
                        { value: {{ $rejectedCount }}, name: 'Rejected' },
                        { value: {{ $approvedCount }}, name: 'Approved' }
                      ]
                    }]
                  });
                });
              </script>
            </div>

          </div><!-- End Website Traffic -->

          <!-- News & Updates Traffic -->
        
          
          <!-- End News & Updates -->

        </div><!-- End Right side columns -->

      </div>
    </section>

  </main><!-- End #main -->

<script>
    function applyFilter(filterValue) {
        document.getElementById('filterInput').value = filterValue;
        document.getElementById('filterForm').submit();
    }
</script>

<script>
  $('.dropdown-item').on('click', function() {
    var filter = $(this).text();
    $.ajax({
        url: '/admin/filter-data',
        type: 'GET',
        data: { filter: filter },
        success: function(data) {
            // Update the chart with the new data
            chart.updateSeries([{
                name: 'Bids',
                data: data.bids,
            }, {
                name: 'Revenue',
                data: data.revenue
            }]);
        }
    });
});

</script>
@include('admin.partials.footer')