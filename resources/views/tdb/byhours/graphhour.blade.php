<div class='box box-primary'>
  <div class='box-header with-border'>
    <h3 class='col-xs-6 box-title'>Données de synthèse</h3><i class='pull-right fa fa-fw fa-chevron-down' style='cursor:Pointer;text-align: right;' id='icon-bilan-hour'/>
  </div>
</div>

<div class='box-body' id='table-bilan-hour'>
  <table>
    <tr width='40' height='35'>
      <th width='150'>Période</th>
        @foreach ($tdbhour as $tdbh)            
            <td width='50'>{{ $tdbh->mois }} {{ $tdbh->ANNEE }}</td>
        @endforeach
    </tr>
    <tr width='40' height='25'>
      <th width='150'>Heures prévues</th>
        @foreach ($tdbhour as $tdbh)            
            <td width='50'>{{ $tdbh->prevu }}</td>
        @endforeach
    </tr>
    <tr width='40' height='25'>
      <th width='150'>Heures réalisées</th>
        @foreach ($tdbhour as $tdbh)            
            <td width='50'>{{ $tdbh->Temps_realise }}</td>
        @endforeach
    </tr>
    <tr width='40' height='25'>
      <th width='150'>Ecart</th>
        @foreach ($tdbhour as $tdbh)  
          <td width='50'>{{ $tdbh->ecart }}</td>
        @endforeach
    </tr>
    <tr width='40' height='25'>
        <th width='150'>Cumul</th>
        @foreach ($tdbhour as $tdbh)  
          <td width='50'>{{ $tdbh->cumul }}</td>
        @endforeach

    </tr>
    </table>
<!-- //    </td>
//    <td>
//    <table>  
//    </table>
//    </td>
//    </table> -->
  </div>
  <br></br>
  <div class='box box-primary'>
    <div class='box-header with-border'>
      <h3 class='col-xs-6 box-title'>Graph de synthèse</h3>
    </div>
  </div>
<div class='box-body'>
  <div id='chartContainer' style='height: 400px; width: 760px;'></div>
</div>
<script type="text/javascript" src="{{ asset('plugins/canvasjs-1.6.2/canvasjs.min.js') }}"></script>

<script type='text/javascript'>
    CanvasJS.addColorSet('Test',
        [
        '#74a5c1',
        '#3c8dbc',
        '#00a65a',
        '#f56954'                
    ]);
    var chart = new CanvasJS.Chart('chartContainer', {
      colorSet: 'Test',
        animationEnabled: true,
        backgroundColor: '#f1f1f1',
      title:{
        text: 'Bilan des heures',
        fontSize: 30
      },
      toolTip: {
        shared: true
      }, 
      axisY: {
        title: 'Heures'
      },
      axisX: {
        title: 'Période'
      },

      legend:{
        fontFamily: 'Open sans',
        verticalAlign: 'top',
        horizontalAlign: 'center'
      },
      data: [
      {
        type: 'column', 
        name: 'Heures prévues',
        legendText: 'Heures prévues',
        showInLegend: true, 
        dataPoints:[
        @foreach ($tdbhour as $key => $tdbh)
          @if ($key == 12)
            {label: '{{ $tdbh->mois }}', y: {{{ $tdbh->prevu or '0' }}} }
          @else
            {label: '{{ $tdbh->mois }}', y: {{{ $tdbh->prevu or '0' }}} },
          @endif
        @endforeach

        ]
      },
      {
        type: 'column', 
        name: 'Heures réalisées',
        legendText: 'Heures réalisées',
        // axisYType: 'secondary',
        showInLegend: true,
        dataPoints:[
        @foreach ($tdbhour as $key => $tdbh)
          @if ($key == 12)
            {label: '{{ $tdbh->mois }}', y: {{ $tdbh->Temps_realise or 0 }} }
          @else
            {label: '{{ $tdbh->mois }}', y: {{ $tdbh->Temps_realise or 0 }} },
          @endif
        @endforeach
        
        ]
      },
      {
        type: 'line', 
        name: 'Ecart',
        legendText: 'Ecart',
        // axisYType: 'secondary',
        showInLegend: true,
        dataPoints:[
          @foreach ($tdbhour as $key => $tdbh)
            @if ($key == 12)
              {label: '{{ $tdbh->mois }}', y: {{ $tdbh->ecart or 0 }} }
            @else
              {label: '{{ $tdbh->mois }}', y: {{ $tdbh->ecart or 0 }} },
            @endif
          @endforeach

        ]
      },
      {
        type: 'line', 
        name: 'Cumul',
        legendText: 'Ecart cumulé',
        showInLegend: true,
        dataPoints:[
        @foreach ($tdbhour as $key => $tdbh)
            @if ($key == 12)
              {label: '{{ $tdbh->mois }}', y: {{ $tdbh->cumul or 0 }} }
            @else
              {label: '{{ $tdbh->mois }}', y: {{ $tdbh->cumul or 0 }} },
            @endif
          @endforeach

                  ]
                }
      ],
          legend:{
            cursor:'pointer',
            itemclick: function(e){
              if (typeof(e.dataSeries.visible) === 'undefined' || e.dataSeries.visible) {
                e.dataSeries.visible = false;
              }
              else {
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          },
        });

    chart.render();
</script>