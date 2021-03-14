@extends('master.main')

@section('content')
<div class="container-md mx-md-auto">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <div class="row justify-content-md-center">
       <div class="col-md-6 col-12" dir="ltr">
          <div id="anylise"></div>
       </div>
       <div class="col-md-6 col-12" dir="ltr">
          <div id="week"></div>
       </div>
       <div class="col-md-2 col-6">
            <div class="card-box p-1 text-center">
              <h1 class="text-dark"><span >{{$monty_count}}</span> {{_('views')}}</h1>
              <h4 class="text-muted text-truncate">monty</h4>
            </div>
      </div>
      <div class="col-md-2 col-6">
           <div class="card-box p-1 text-center">
             <h1 class="text-dark"><span >{{$week_count}}</span> {{_('views')}}</h1>
             <h4 class="text-muted text-truncate">week</h4>
           </div>
     </div>
       <div class="col-md-2 col-6">
            <div class="card-box p-1 text-center">
              <h1 class="text-dark"><span >{{$movies}}</span> {{_('views')}}</h1>
              <h4 class="text-muted text-truncate">day/movies</h4>
            </div>
      </div>
      <div class="col-md-2 col-6">
           <div class="card-box p-1 text-center">
             <h1 class="text-dark"><span >{{$tvshows}}</span> {{_('views')}}</h1>
             <h4 class="text-muted text-truncate">day/tvshows</h4>
           </div>
     </div>
     <div class="col-md-2 col-6">
          <div class="card-box p-1 text-center">
            <h1 class="text-dark"><span >{{$episodes}}</span> {{_('views')}}</h1>
            <h4 class="text-muted text-truncate">day/episodes</h4>
          </div>
    </div>
  </div>
</div>


  <script type="text/javascript">
  var listo = {!! $monty !!} ;
  var options = {
    chart: {
      foreColor: '#fff',
      height: 380,
      width: "100%",
      type: "bar",
      animations: {
        initialAnimation: {
          enabled: false
        }
      }
    },
plotOptions: {
  bar: {
    columnWidth: '25%',
    distributed: true
  }
},
title: {
  text: '30 days',
  offsetX: 30,
      color: '#fff',
  style: {
    fontSize: '24px',
        color: '#fff',
    cssClass: 'apexcharts-yaxis-title'
  }
},
legend: {
  show: false,
},
    series: [
      {
        name: "views",
        data: listo
      }
    ],

  };

  var chart = new ApexCharts(document.querySelector("#anylise"), options);
  chart.render();
  var week = {!! $week !!} ;
  var options_week = {
    chart: {
      foreColor: '#fff',
      height: 380,
      width: "100%",
      type: "bar",
      animations: {
        initialAnimation: {
          enabled: false
        }
      }
    },
plotOptions: {
  bar: {
    columnWidth: '25%',
    distributed: true
  }
},
title: {
  text: '7 days',
  offsetX: 30,
      color: '#fff',
  style: {
    fontSize: '24px',
        color: '#fff',
    cssClass: 'apexcharts-yaxis-title'
  }
},
legend: {
  show: true,
},
    series: [
      {
        name: "views",
        data: week
      }
    ],

  };

  var chartweek = new ApexCharts(document.querySelector("#week"), options_week);
  chartweek.render();
  </script>
@endsection
