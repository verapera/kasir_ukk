@extends('home')
@section('content')
@section('title','Dashboard')
<?php
$penjualan = DB::table('penjualans')->whereYear('created_at','=',now()->year)
                                    ->whereMonth('created_at','=',now()->month)
                                    ->sum('total_harga');
$produk = DB::table('produks')->whereNull('deleted_at')->count('produk_id');
?>

    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-strech">
          <div class="card w-100">
            <div class="card-body">
              <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                <div class="mb-3 mb-sm-0">
                  <h5 class="card-title fw-semibold">Hello <span class="text-primary">{{ auth()->user()->username }}</span>, wellcome to your <span class="text-primary">{{ auth()->user()->level }}</span> account!</h5>
                </div>
              </div>
              <div id="chart"></div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="row">
            <div class="col-lg-12">
              <!-- Yearly Breakup -->
              <div class="card overflow-hidden">
                <div class="card-body p-4">
                  <h5 class="card-title mb-9 fw-semibold">Total produk :</h5>
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h4 class="fw-semibold mb-3">{{ $produk }} items</h4>
                      <div class="d-flex align-items-center mb-3">
                        <p class="fs-3 mb-0">All items</p>
                      </div>
                      <div class="d-flex align-items-center">
                        <div class="me-4">
                          <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                          <span class="fs-2">{{ date('Y') }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="d-flex justify-content-center">
                        <div id="breakup"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <!-- Monthly Earnings -->
              <div class="card">
                <div class="card-body">
                  <div class="row alig n-items-start">
                    <div class="col-8">
                      <h5 class="card-title mb-9 fw-semibold"> Penjualan bulan ini : </h5>
                      <h4 class="fw-semibold mb-3">Rp. {{ number_format($penjualan) }}</h4>
                      <div class="d-flex align-items-center pb-1">
                        <span
                          class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                          <i class="ti ti-arrow-up-right text-danger"></i>
                        </span>
                        <p class="fs-3 mb-0">Newest year</p>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="d-flex justify-content-end">
                        <div
                          class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                          <i class="ti ti-currency-cash fs-6"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div id="earning"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">Design by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline fw-semibold">AdminMart.com</a> Developed by <span class="text-primary fw-semibold">vera fatika XII-RPLC</span> </p>
      </div>
      @section('js')
          <script>
            $(function () {


// =====================================
// Profit
// =====================================
var chart = {
  series: [
    { name: "Penjualan:", data: [{{ $p1 }}, {{ $p2 }},{{ $p3 }},{{ $p4 }}, {{ $p5 }}] },
  ],

  chart: {
    type: "bar",
    height: 345,
    offsetX: -15,
    toolbar: { show: true },
    foreColor: "#adb0bb",
    fontFamily: 'inherit',
    sparkline: { enabled: false },
  },


  colors: ["#5D87FF", "#49BEFF"],


  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "35%",
      borderRadius: [6],
      borderRadiusApplication: 'end',
      borderRadiusWhenStacked: 'all'
    },
  },
  markers: { size: 0 },

  dataLabels: {
    enabled: false,
  },


  legend: {
    show: false,
  },


  grid: {
    borderColor: "rgba(0,0,0,0.1)",
    strokeDashArray: 3,
    xaxis: {
      lines: {
        show: false,
      },
    },
  },

  xaxis: {
    type: "category",
    categories: ["{{ $p1_date }}","{{ $p2_date }}","{{ $p3_date }}","{{ $p4_date }}","{{ $p5_date }}"],
    labels: {
      style: { cssClass: "grey--text lighten-2--text fill-color" },
    },
  },


  yaxis: {
    show: true,
    min: 0,
    max: 250000 ,
    tickAmount: 4,
    labels: {
      style: {
        cssClass: "grey--text lighten-2--text fill-color",
      },
    },
  },
  stroke: {
    show: true,
    width: 3,
    lineCap: "butt",
    colors: ["transparent"],
  },


  tooltip: { theme: "light" },

  responsive: [
    {
      breakpoint: 600,
      options: {
        plotOptions: {
          bar: {
            borderRadius: 3,
          }
        },
      }
    }
  ]


};

var chart = new ApexCharts(document.querySelector("#chart"), chart);
chart.render();


// =====================================
// Breakup
// =====================================
var breakup = {
  color: "#adb5bd",
  series: [38, 40, 25],
  labels: ["2022", "2021", "2020"],
  chart: {
    width: 180,
    type: "donut",
    fontFamily: "Plus Jakarta Sans', sans-serif",
    foreColor: "#adb0bb",
  },
  plotOptions: {
    pie: {
      startAngle: 0,
      endAngle: 360,
      donut: {
        size: '75%',
      },
    },
  },
  stroke: {
    show: false,
  },

  dataLabels: {
    enabled: false,
  },

  legend: {
    show: false,
  },
  colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],

  responsive: [
    {
      breakpoint: 991,
      options: {
        chart: {
          width: 150,
        },
      },
    },
  ],
  tooltip: {
    theme: "dark",
    fillSeriesColor: false,
  },
};

var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
chart.render();



// =====================================
// Earning
// =====================================
var earning = {
  chart: {
    id: "sparkline3",
    type: "area",
    height: 60,
    sparkline: {
      enabled: true,
    },
    group: "sparklines",
    fontFamily: "Plus Jakarta Sans', sans-serif",
    foreColor: "#adb0bb",
  },
  series: [
    {
      name: "Earnings",
      color: "#49BEFF",
      data: [25, 66, 20, 40, 12, 58, 20],
    },
  ],
  stroke: {
    curve: "smooth",
    width: 2,
  },
  fill: {
    colors: ["#f3feff"],
    type: "solid",
    opacity: 0.05,
  },

  markers: {
    size: 0,
  },
  tooltip: {
    theme: "dark",
    fixed: {
      enabled: true,
      position: "right",
    },
    x: {
      show: false,
    },
  },
};
new ApexCharts(document.querySelector("#earning"), earning).render();
})
          </script>
      @endsection
@endsection